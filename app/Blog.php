<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Shetabit\Visitor\Traits\Visitable;

class Blog extends Model
{
    use Visitable;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'image',
        'user_id',
        'published_at',
        'approved_by',
        'approved_at',
        'additional_info',
        'seo_description',
        'seo_keywords',
        'seo_og_title',
        'seo_og_description',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    /**
     * MUTATORS
     */
    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = $title;
        $this->attributes['slug'] = Str::slug($title);
    }

    /**
     * HELPER METHODS
     */
    public function deleteImage()
    {
        Storage::delete($this->image);
    }

    public function isApproved()
    {
        return ($this->approved_by !== NULL && $this->approved_at !== NULL);
    }

    public function isPublished()
    {
        return $this->published_at <= Carbon::now();
    }

    /*
     * The below method will give all the image names used in the blog body
     */
    public function getAllBlogDetailImageNames()
    {
        $imageNames = array();
        $result = array();
        preg_match_all('/<img[^>]+>/i', $this->body, $result);
        $result = $result[0];
        foreach($result as $img_tag)
        {
            preg_match_all('/(src)=("[^"]*")/i',$img_tag, $src);
            $imagePath = $src[2][0];
            $imagePath = substr($imagePath, 1, strlen($imagePath)-2);
            $imageName = explode('/', $imagePath);
            $imageName = $imageName[sizeof($imageName)-1];
            $imageNames[] = $imageName;
        }
        return $imageNames;
    }

    /*
     * The below method will give all the image names present in the 'storage/blog-detail-images' directory
     */
    public static function getAllUploadedBlogDetailImageNames(){
        $imagesInFolder = File::files("storage/blog-detail-images");
        $allImageNames = array();
        foreach($imagesInFolder as $path) {
            $image = pathinfo($path);
            $allImageNames[] = $image["basename"];
        }
        return $allImageNames;
    }

    public static function deleteOrphanImages(){
        $existingImages = Blog::getAllUploadedBlogDetailImageNames();
        $requiredImages = array();
        $blogs = Blog::all();
        foreach ($blogs as $blog){
            $requiredImages = array_merge($requiredImages, $blog->getAllBlogDetailImageNames());
        }
        foreach ($existingImages as $image){
            if(!in_array($image, $requiredImages)){
                Storage::delete("blog-detail-images/$image");
            }
        }
    }

    /**
     * ACCESSORS
     */
    public function getApprovedDateAttribute()
    {
        return $this->approved_at->diffForHumans();
    }

    public function getPublishedDateAttribute()
    {
        return $this->published_at->diffForHumans();
    }

    public function getTruncatedExcerptAttribute()
    {
        return Str::limit($this->excerpt, 85);
    }

    public function getUrlAttribute()
    {
        return url("blogs/{$this->slug}");
    }

    public function getPreviewUrlAttribute()
    {
        return url("control-panel/blogs/preview/{$this->slug}");
    }


    /**
     * RELATIONSHIP METHODS
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    /**
     * SCOPE QUERIES
     */
    public function scopeJoinAllRelatedTables($query)
    {
        return $query->join('users AS author', 'blogs.user_id', '=', 'author.id')
            ->leftJoin('users AS approved', 'blogs.approved_by', '=', 'approved.id')
            ->leftJoin("blog_tag", "blogs.id", '=', "blog_tag.blog_id")
            ->leftJoin("tags", "tags.id", "=", "blog_tag.tag_id")
            ->groupBy('blogs.id')
            ->select('blogs.*', 'author.name AS user_name', 'approved.name AS approved_by_name')
            ->selectRaw('GROUP_CONCAT(tags.name," ") AS tag_names');
    }

    public function scopeFilter($query)
    {
        if(!(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())){
            return $query->where('user_id', auth()->user()->id);
        }
        return $query;
    }

    public function scopeSearch($query, $searchValue)
    {
        if ($searchValue) {
            return $query->where(function ($q) use ($searchValue) {
            $q->where('title', 'like', "%{$searchValue}%")
                ->orWhere('author.name', 'like', "%{$searchValue}%")
                ->orWhere('tags.name', 'like', "%{$searchValue}%")
                ->orWhere('approved.name', 'like', "%{$searchValue}%");
        });
        }
        return $query;
    }

    public function scopeOrder($query, $orderBy)
    {
        if ($orderBy) {
            $columns = ["sr_no", "image", "title", "user_name", "published_at", "tags.name", "approved_by_name", "approved_at", "actions"];
            return $query->orderBy($columns[$orderBy[0]['column']], $orderBy[0]['dir']);
        }
        return $query;
    }

    public function scopeLimitBy($query, $start, $length)
    {
        if ($length != -1) {
            return $query->offset($start)->limit($length);
        }
        return $query;
    }

    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', now());
    }

    public function scopeApproved($query)
    {
        return $query->where('approved_at', '!=', NULL)->where('approved_by', '!=', NULL);
    }

    public function scopeSearchTitle($query, $search)
    {
        if($search){
            return $query->where('title', 'LIKE', "%$search%");
        }else{
            return $query;
        }
    }

    public function scopeMostVisitedBlogsOfCurrentMonth($query)
    {
        return DB::select("SELECT id, DATE_FORMAT(created_at, '%m') as month, shetabit_visits.url, shetabit_visits.visitable_id FROM `shetabit_visits` WHERE shetabit_visits.url like 'http://localhost:8000/blogs/%' AND month(created_at) = month(CURDATE())");
    }
}
