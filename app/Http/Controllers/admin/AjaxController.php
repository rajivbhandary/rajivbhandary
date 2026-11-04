<?php

namespace App\Http\Controllers\admin;

use App\Blog;
use App\Config;
use App\Enquiry;
use App\FRE;
use App\Http\Controllers\Controller;
use App\Page;
use App\Property;
use App\User;
use App\Tag;
use App\Testimonial;
use App\Visit;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    /** Tables an author may load; everything else is admin-only. */
    private const AUTHOR_PAGES = ['manage_blogs', 'manage_trashed_blogs'];

    public function getData(Request $request)
    {
        $user = $request->user();
        $page = $request->get('page');
        if (!($user->isAdmin() || $user->isSuperAdmin()) && !in_array($page, self::AUTHOR_PAGES, true)) {
            abort(403);
        }

        $search_parameter = null;
        $order_by = null;
        $start = (int) $request->get('start', 0);
        $length = (int) $request->get('length', 10);
        $draw = (int) $request->get('draw', 1);
        if ($request->has('search')) {
            $search_parameter = $request->input('search.value');
            $order_by = $request->get('order');
        }
        $tables = [
            'manage_blogs' => 'getBlogs',
            'manage_trashed_blogs' => 'getTrashedBlogs',
            'manage_users' => 'getUsers',
            'manage_trashed_users' => 'getTrashedUsers',
            'manage_visits' => 'getVisits',
            'manage_trashed_visits' => 'getTrashedVisits',
            'manage_pages' => 'getPages',
            'manage_tags' => 'getTags',
            'manage_trashed_tags' => 'getTrashedTags',
            'manage_enquiries' => 'getEnquiries',
            'manage_trashed_enquiries' => 'getTrashedEnquiries',
            'manage_testimonials' => 'getTestimonials',
            'manage_properties' => 'getProperties',
            'manage_trashed_properties' => 'getTrashedProperties',
            'manage_fre' => 'getFRE',
            'manage_trashed_fre' => 'getTrashedFRE',
        ];

        if ($page === 'manage_dashboard') {
            return $this->getDashboard($request->get('type'));
        }
        if (!isset($tables[$page])) {
            abort(404);
        }

        return $this->{$tables[$page]}($draw, $search_parameter, $order_by, $start, $length);
    }

    /*
     * This method is general action buttons
     */
    private function getGeneralActionButtons($tag)
    {
        $actionButtons = "<div class='d-flex align-items-center justify-content-center'>";
        if (auth()->user()->can('update', $tag)) {
            $actionButtons .= "<a href='" . route('tags.edit', $tag->id) . "' class='btn btn-label btn-label-primary btn-sm btn-bold m-1 d-flex'><i class='kt-menu__link-icon flaticon-edit'></i>Edit</a>";
        }
        if (auth()->user()->can('delete', $tag)) {
            $actionButtons .= "<a href='#' class='btn btn-label btn-label-danger btn-bold btn-sm m-1 d-flex' data-toggle='modal' onclick='displayTrashModalForm(" . $tag->id . ")' data-target='#deleteModal'><i class='kt-menu__link-icon flaticon2-trash'></i>Trash</a>";
        }
        return $actionButtons . '</div>';
    }

    /*
     * This method is general trashed buttons
     */
    private function getGeneralTrashedActionButtons($tag)
    {
        $actionButtons = "<div class='d-flex align-items-center justify-content-center'>";
        if (auth()->user()->can('restore', $tag)) {
            $actionButtons .= "
                        <a class='btn btn-label-success btn-bold btn-sm m-1 d-flex' href='#' onclick='displayRestoreModalForm(" . $tag->id . ")'
                        data-toggle='modal'
                        data-target='#restoreModal'>
                            <i class='kt-menu__link-icon flaticon-refresh'></i>
                            Restore
                        </a>";
        }
        if (auth()->user()->can('forceDelete', $tag)) {
            $actionButtons .= "<a href='#' class='btn btn-label-danger btn-bold btn-sm m-1 d-flex'
                        onclick='displayDeleteModalForm(" . $tag->id . ")'
                        data-toggle='modal'
                        data-target='#deleteModal'><i class='kt-menu__link-icon flaticon2-trash'></i>Delete</a>";
        }
        return $actionButtons . "</div>";
    }
    
    private function getUsers($draw, $searchParameter, $orderBy, $start, $length)
    {
        $filteredData = User::withoutTrashed()->search($searchParameter)->latest('created_at')->order($orderBy)->limitBy($start, $length)->get();
        $numberOfTotalRows = User::withoutTrashed()->count();
        $numberOfFilteredRows = User::withoutTrashed()->search($searchParameter)->get()->count();
        $data = array();
        for ($i = 0; $i < sizeof($filteredData); $i++) {
            $subarray = [];
            $subarray[] = $i + 1 + $start;
            $subarray[] =
                <<<IMAGE
    <img src="storage/{$filteredData[$i]->image}" class="rounded-circle" alt="User Image" width="100px"/>
IMAGE;
            $subarray[] = e((string) ($filteredData[$i]->name));
            $subarray[] = e((string) ($filteredData[$i]->email));
            $subarray[] = e((string) ($filteredData[$i]->phone_number));
            $subarray[] = e((string) ($filteredData[$i]->role));
            $subarray[] = $this->getUserActionButtons($filteredData[$i]);

            $data[] = $subarray;
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $numberOfTotalRows,
            "recordsFiltered" => $numberOfFilteredRows,
            "data" => $data
        );

        return response()->json($output);
    }

    private function getTrashedUsers($draw, $searchParameter, $orderBy, $start, $length)
    {
        $filteredData = User::onlyTrashed()->latest('deleted_at')->search($searchParameter)->order($orderBy)->limitBy($start, $length)->get();
        $numberOfTotalRows = User::onlyTrashed()->count();
        $numberOfFilteredRows = User::onlyTrashed()->search($searchParameter)->get()->count();
        $data = array();
        for ($i = 0; $i < sizeof($filteredData); $i++) {
            $subarray = [];
            $subarray[] = $i + 1 + $start;
            $subarray[] =
                <<<IMAGE
    <img src="storage/{$filteredData[$i]->image}" class="rounded-circle" alt="User Image" width="100px"/>
IMAGE;
            $subarray[] = e((string) ($filteredData[$i]->name));
            $subarray[] = e((string) ($filteredData[$i]->email));
            $subarray[] = e((string) ($filteredData[$i]->phone_number));
            $subarray[] = e((string) ($filteredData[$i]->role));
            $subarray[] = $this->getTrashedUserActionButtons($filteredData[$i]);

            $data[] = $subarray;
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $numberOfTotalRows,
            "recordsFiltered" => $numberOfFilteredRows,
            "data" => $data
        );

        return response()->json($output);
    }

    private function getUserActionButtons($user)
    {
        $actionButtons = "<div class='d-flex align-items-center justify-content-center'>";
        if (auth()->user()->can('makeAdmin', $user)) {
            $actionButtons .=
                "<a class='btn btn-label-success btn-label btn-sm btn-bold' href='#' data-toggle='modal' onclick='makeAdmin(" . $user->id . ")' data-target='#makeAdminModal'><i class='kt-menu__link-icon flaticon2-user-1'></i>
    Make Admin
</a>
";
        }
        if (auth()->user()->can('revokeAdmin', $user)) {
            $actionButtons .=
                "<a class='btn btn-label-danger btn-label btn-sm btn-bold' href='#' data-toggle='modal' onclick='revokeAdmin(" . $user->id . ")' data-target='#revokeAdminModal'><i class='kt-menu__link-icon flaticon2-user-1'></i>
    Revoke Admin
</a
";
        }
        return $actionButtons . "</div>";
    }

    /*
     * This method is only for action buttons for users
     */
    private function getTrashedUserActionButtons($user)
    {
        $actionButtons = "<div class='d-flex align-items-center justify-content-center'>";
        if (auth()->user()->can('restore', $user)) {
            $actionButtons .= "
                        <a class='btn btn-label-success btn-bold btn-sm m-1 d-flex' href='#' onclick='displayRestoreModalForm(" . $user->id . ")'
                        data-toggle='modal'
                        data-target='#restoreModal'>
                            <i class='kt-menu__link-icon flaticon-refresh'></i>
                            Restore
                        </a>";
        }
        if (auth()->user()->can('forceDelete', $user)) {
            $actionButtons .= "<a href='#' class='btn btn-label-danger btn-bold btn-sm m-1 d-flex'
                        onclick='displayDeleteModalForm(" . $user->id . ")'
                        data-toggle='modal'
                        data-target='#deleteModal'><i class='kt-menu__link-icon flaticon2-trash'></i>Delete</a>";
        }
        return $actionButtons . "</div>";
    }

    private function getTags($draw, $searchParameter, $orderBy, $start, $length)
    {
        $filteredData = Tag::withoutTrashed()->search($searchParameter)->order($orderBy)->limitBy($start, $length)->get();
        $numberOfTotalRows = Tag::withoutTrashed()->count();
        $numberOfFilteredRows = Tag::withoutTrashed()->search($searchParameter)->get()->count();
        $data = array();
        for ($i = 0; $i < sizeof($filteredData); $i++) {
            $subarray = [];
            $subarray[] = $i + 1 + $start;
            $subarray[] = e((string) ($filteredData[$i]->name));
            $subarray[] = $this->getTagActionButtons($filteredData[$i]);
            $data[] = $subarray;
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $numberOfTotalRows,
            "recordsFiltered" => $numberOfFilteredRows,
            "data" => $data
        );

        return response()->json($output);
    }

    private function getTrashedTags($draw, $searchParameter, $orderBy, $start, $length)
    {
        $filteredData = Tag::onlyTrashed()->search($searchParameter)->order($orderBy)->limitBy($start, $length)->get();
        $numberOfTotalRows = Tag::onlyTrashed()->count();
        $numberOfFilteredRows = Tag::onlyTrashed()->search($searchParameter)->get()->count();
        $data = array();
        for ($i = 0; $i < sizeof($filteredData); $i++) {
            $subarray = [];
            $subarray[] = $i + 1 + $start;
            $subarray[] = e((string) ($filteredData[$i]->name));
            $subarray[] = $this->getTrashedTagActionButtons($filteredData[$i]);
            $data[] = $subarray;
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $numberOfTotalRows,
            "recordsFiltered" => $numberOfFilteredRows,
            "data" => $data
        );

        return response()->json($output);
    }

     /*
     * This method is only for action buttons for blogs
     */
    private function getTagActionButtons($tag)
    {
        $actionButtons = "<div class='d-flex align-items-center justify-content-center'>";
        if (auth()->user()->can('update', $tag)) {
            $actionButtons .= "<a href='" . route('tags.edit', $tag->id) . "' class='btn btn-label btn-label-primary btn-sm btn-bold m-1 d-flex'><i class='kt-menu__link-icon flaticon-edit'></i>Edit</a>";
        }
        if (auth()->user()->can('delete', $tag)) {
            $actionButtons .= "<a href='#' class='btn btn-label btn-label-danger btn-bold btn-sm m-1 d-flex' data-toggle='modal' onclick='displayTrashModalForm(" . $tag->id . ")' data-target='#deleteModal'><i class='kt-menu__link-icon flaticon2-trash'></i>Trash</a>";
        }
        return $actionButtons . '</div>';
    }

    /*
     * This method is only for action buttons for tags
     */
    private function getTrashedTagActionButtons($tag)
    {
        $actionButtons = "<div class='d-flex align-items-center justify-content-center'>";
        if (auth()->user()->can('restore', $tag)) {
            $actionButtons .= "
                        <a class='btn btn-label-success btn-bold btn-sm m-1 d-flex' href='#' onclick='displayRestoreModalForm(" . $tag->id . ")'
                        data-toggle='modal'
                        data-target='#restoreModal'>
                            <i class='kt-menu__link-icon flaticon-refresh'></i>
                            Restore
                        </a>";
        }
        if (auth()->user()->can('forceDelete', $tag)) {
            $actionButtons .= "<a href='#' class='btn btn-label-danger btn-bold btn-sm m-1 d-flex'
                        onclick='displayDeleteModalForm(" . $tag->id . ")'
                        data-toggle='modal'
                        data-target='#deleteModal'><i class='kt-menu__link-icon flaticon2-trash'></i>Delete</a>";
        }
        return $actionButtons . "</div>";
    }

    

     /*
    * This method is only for action buttons for pages
    */
    private function getPageActionButtons($page)
    {
        $actionButtons = "<div class='d-flex align-items-center justify-content-center'>";
        if (auth()->user()->can('update', $page)) {
            $actionButtons .= "<a href='" . route('pages.edit', $page->id) . "' class='btn btn-label btn-label-primary btn-sm btn-bold m-1 d-flex'><i class='kt-menu__link-icon flaticon-edit'></i>Edit</a>";
        }
        return $actionButtons . '</div>';
    }


    private function getBlogs($draw, $searchParameter, $orderBy, $start, $length)
    {
        $query = Blog::withoutTrashed()->joinAllRelatedTables()->filter()->search($searchParameter);
        if($orderBy != null){
            $query = $query->latest('published_at');
        }
        $filteredData = $query->limitBy($start, $length)->get();
        $numberOfTotalRows = Blog::withoutTrashed()->filter()->count();
        $numberOfFilteredRows = Blog::withoutTrashed()->joinAllRelatedTables()->filter()->search($searchParameter)->get()->count();
        $data = array();
        for ($i = 0; $i < sizeof($filteredData); $i++) {
            $subarray = [];
            $subarray[] = $i + 1 + $start;
            $subarray[] = <<<IMAGE
<img src="storage/{$filteredData[$i]->image}" class="" alt="Blog Image" width="150px"/>
IMAGE;
            $subarray[] = e((string) ($filteredData[$i]->title));
            $subarray[] = e((string) ($filteredData[$i]->user_name));
            $subarray[] = e((string) ($filteredData[$i]->published_at ? $filteredData[$i]->published_date : 'Pending'));
            $subarray[] = e((string) ($filteredData[$i]->tag_names));
            $subarray[] = e((string) ($filteredData[$i]->approved_by_name ? $filteredData[$i]->approved_by_name : 'Pending'));
            $subarray[] = e((string) ($filteredData[$i]->approved_at ? $filteredData[$i]->approved_date : 'Pending'));
            $subarray[] = $this->getBlogActionButtons($filteredData[$i]);
            $subarray[] = <<<PREVIEW
<div class="d-flex align-items-center justify-content-center">
    <a class='btn btn-label btn-label-dark btn-bold btn-sm btn-icon m-1 d-flex' href='{$filteredData[$i]->preview_url}'><i class='kt-menu__link-icon la la-eye'></i></a>
</div>
PREVIEW;

            $data[] = $subarray;
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $numberOfTotalRows,
            "recordsFiltered" => $numberOfFilteredRows,
            "data" => $data
        );

        return response()->json($output);
    }

    private function getTrashedBlogs($draw, $searchParameter, $orderBy, $start, $length)
    {
        $query = Blog::onlyTrashed()->joinAllRelatedTables()->filter()->search($searchParameter);
        if($orderBy != null){
            $query = $query->latest('deleted_at');
        }
        $filteredData = $query->order($orderBy)->limitBy($start, $length)->get();
        $numberOfTotalRows = Blog::onlyTrashed()->filter()->count();
        $numberOfFilteredRows = Blog::onlyTrashed()->joinAllRelatedTables()->filter()->search($searchParameter)->get()->count();
        $data = array();
        for ($i = 0; $i < sizeof($filteredData); $i++) {
            $subarray = [];
            $subarray[] = $i + 1 + $start;
            $subarray[] = <<<IMAGE
<img src="storage/{$filteredData[$i]->image}" class="" alt="Blog Image" width="150px"/>
IMAGE;
            $subarray[] = e((string) ($filteredData[$i]->title));
            $subarray[] = e((string) ($filteredData[$i]->user_name));
            $subarray[] = e((string) ($filteredData[$i]->published_at ? $filteredData[$i]->published_date : 'Pending'));
            $subarray[] = e((string) ($filteredData[$i]->tag_names));
            $subarray[] = e((string) ($filteredData[$i]->approved_by_name ? $filteredData[$i]->approved_by_name : 'Pending'));
            $subarray[] = e((string) ($filteredData[$i]->approved_at ? $filteredData[$i]->approved_date : 'Pending'));
            $subarray[] = $this->getTrashedBlogActionButtons($filteredData[$i]);
            $data[] = $subarray;
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $numberOfTotalRows,
            "recordsFiltered" => $numberOfFilteredRows,
            "data" => $data
        );

        return response()->json($output);
    }

    /*
     * This method is only for action buttons for blogs
     */
    private function getBlogActionButtons($blog)
    {
        $actionButtons = "<div class='d-flex align-items-center justify-content-center'>";
        if (auth()->user()->can('update', $blog)) {
            $actionButtons .= "<a href='" . route('blogs.edit', $blog->id) . "' class='btn btn-label btn-label-primary btn-sm btn-bold m-1 d-flex'><i class='kt-menu__link-icon flaticon-edit'></i>Edit</a>";
        }
        if (auth()->user()->can('delete', $blog)) {
            $actionButtons .= "<a href='#' class='btn btn-label btn-label-danger btn-bold btn-sm m-1 d-flex' data-toggle='modal' onclick='displayTrashModalForm(" . $blog->id . ")' data-target='#deleteModal'><i class='kt-menu__link-icon flaticon2-trash'></i>Trash</a>";
        }
        if (auth()->user()->can('approve', $blog)) {
            $actionButtons .= "<a class='btn btn btn-label-success btn-bold btn-sm m-1 d-flex' href='#' data-toggle='modal' onclick='displayApproveModalForm(" . $blog->id . ")' data-target='#approveModal'><i class='kt-menu__link-icon flaticon2-check-mark'></i>
                                Approve
                            </a>";
        }
        if (auth()->user()->can('disapprove', $blog)) {
            $actionButtons .= "<a class='btn btn-label btn-label-warning btn-bold btn-sm m-1 d-flex' href='#' data-toggle='modal' onclick='displayDisapproveModalForm(" . $blog->id . ")' data-target='#disapproveModal'><i class='kt-menu__link-icon flaticon2-cancel-music'></i>
                    Disapprove
                </a>";
        }
        return $actionButtons . '</div>';
    }

    /*
     * This method is only for action buttons for blogs
     */
    private function getTrashedBlogActionButtons($blog)
    {
        $actionButtons = "<div class='d-flex align-items-center justify-content-center'>";
        if (auth()->user()->can('restore', $blog)) {
            $actionButtons .= "
                        <a class='btn btn-label-success btn-bold btn-sm m-1 d-flex' href='#' onclick='displayRestoreModalForm(" . $blog->id . ")'
                        data-toggle='modal'
                        data-target='#restoreModal'>
                            <i class='kt-menu__link-icon flaticon-refresh'></i>
                            Restore
                        </a>";
        }
        if (auth()->user()->can('forceDelete', $blog)) {
            $actionButtons .= "<a href='#' class='btn btn-label-danger btn-bold btn-sm m-1 d-flex'
                        onclick='displayDeleteModalForm(" . $blog->id . ")'
                        data-toggle='modal'
                        data-target='#deleteModal'><i class='kt-menu__link-icon flaticon2-trash'></i>Delete</a>";
        }
        return $actionButtons . "</div>";
    }

    private function getPages($draw, $searchParameter, $orderBy, $start, $length)
    {
        $query = Page::search($searchParameter);
        if($orderBy != null){
            $query = $query->latest();
        }
        $filteredData = $query->order($orderBy)->limitBy($start, $length)->get();
        $numberOfTotalRows = Page::count();
        $numberOfFilteredRows = Page::search($searchParameter)->get()->count();
        $data = array();
        for ($i = 0; $i < sizeof($filteredData); $i++) {
            $subarray = [];
            $subarray[] = $i + 1 + $start;
            $subarray[] = e((string) ($filteredData[$i]->route_url));
            $subarray[] = e((string) ($filteredData[$i]->seo_description));
            $subarray[] = e((string) ($filteredData[$i]->seo_keywords));
            $subarray[] = e((string) ($filteredData[$i]->seo_og_title));
            $subarray[] = e((string) ($filteredData[$i]->seo_og_description));
            $subarray[] = $this->getPageActionButtons($filteredData[$i]);

            $data[] = $subarray;
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $numberOfTotalRows,
            "recordsFiltered" => $numberOfFilteredRows,
            "data" => $data
        );

        return response()->json($output);
    }

    private function getVisits($draw, $searchParameter, $orderBy, $start, $length)
    {
        $filteredData = Visit::withoutTrashed()->latest('created_at')->search($searchParameter)->order($orderBy)->limitBy($start, $length)->get();
        $numberOfTotalRows = Visit::withoutTrashed()->count();
        $numberOfFilteredRows = Visit::withoutTrashed()->search($searchParameter)->get()->count();
        $data = array();
        for ($i = 0; $i < sizeof($filteredData); $i++) {
            $subarray = [];
            $subarray[] = $i + 1 + $start;
            $subarray[] = e((string) ($filteredData[$i]->created_at));
            $subarray[] = e((string) ($filteredData[$i]->method));
            $subarray[] = e((string) ($filteredData[$i]->url));
            $subarray[] = e((string) ($filteredData[$i]->ip));
            $subarray[] = e((string) ($filteredData[$i]->platform));
            $subarray[] = e((string) ($filteredData[$i]->browser));
            $subarray[] = e((string) ($filteredData[$i]->device));
            $subarray[] = e((string) ($filteredData[$i]->languages));
            $subarray[] = $this->getGeneralActionButtons($filteredData[$i]);

            $data[] = $subarray;
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $numberOfTotalRows,
            "recordsFiltered" => $numberOfFilteredRows,
            "data" => $data
        );

        return response()->json($output);
    }

    private function getTrashedVisits($draw, $searchParameter, $orderBy, $start, $length)
    {
        $filteredData = Visit::onlyTrashed()->latest('created_at')->search($searchParameter)->order($orderBy)->limitBy($start, $length)->get();
        $numberOfTotalRows = Visit::onlyTrashed()->count();
        $numberOfFilteredRows = Visit::onlyTrashed()->search($searchParameter)->get()->count();
        $data = array();
        for ($i = 0; $i < sizeof($filteredData); $i++) {
            $subarray = [];
            $subarray[] = $i + 1 + $start;
            $subarray[] = e((string) ($filteredData[$i]->created_at));
            $subarray[] = e((string) ($filteredData[$i]->method));
            $subarray[] = e((string) ($filteredData[$i]->url));
            $subarray[] = e((string) ($filteredData[$i]->ip));
            $subarray[] = e((string) ($filteredData[$i]->platform));
            $subarray[] = e((string) ($filteredData[$i]->browser));
            $subarray[] = e((string) ($filteredData[$i]->device));
            $subarray[] = e((string) ($filteredData[$i]->languages));
            $subarray[] = $this->getGeneralTrashedActionButtons($filteredData[$i]);

            $data[] = $subarray;
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $numberOfTotalRows,
            "recordsFiltered" => $numberOfFilteredRows,
            "data" => $data
        );

        return response()->json($output);
    }

    
    /*
     * This method is only for action buttons for testimonials
     */
    private function getTestimonialActionButtons($testimonial)
    {
        $actionButtons = "<div class='d-flex align-items-center justify-content-center'>";
        if (auth()->user()->can('update', $testimonial)) {
            $actionButtons .= "<a href='" . route('testimonials.edit', $testimonial->id) . "' class='btn btn-label btn-label-primary btn-sm btn-bold m-1 d-flex'><i class='kt-menu__link-icon flaticon-edit'></i>Edit</a>";
        }
        if (auth()->user()->can('delete', $testimonial)) {
            $actionButtons .= "<a href='#' class='btn btn-label btn-label-danger btn-bold btn-sm m-1 d-flex' data-toggle='modal' onclick='displayTrashModalForm(" . $testimonial->id . ")' data-target='#deleteModal'><i class='kt-menu__link-icon flaticon2-trash'></i>Trash</a>";
        }
        return $actionButtons . '</div>';
    }


    private function getTestimonials($draw, $searchParameter, $orderBy, $start, $length)
    {
        $filteredData = Testimonial::withoutTrashed()->latest()->search($searchParameter)->order($orderBy)->limitBy($start, $length)->get();
        $numberOfTotalRows = Testimonial::withoutTrashed()->latest()->count();
        $numberOfFilteredRows = Testimonial::withoutTrashed()->latest()->search($searchParameter)->get()->count();
        $data = array();
        for ($i = 0; $i < sizeof($filteredData); $i++) {
            $subarray = [];
            $subarray[] = $i + 1 + $start;
            $subarray[] =
                <<<IMAGE
    <img src="storage/{$filteredData[$i]->image}" class="rounded-circle" alt="User Image" width="100px"/>
IMAGE;
            $subarray[] = e((string) ($filteredData[$i]->name));
            $subarray[] = e((string) ($filteredData[$i]->city));
            $subarray[] = e((string) ($filteredData[$i]->truncated_testimonial));
            $subarray[] = $this->getTestimonialActionButtons($filteredData[$i]);
            $data[] = $subarray;
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $numberOfTotalRows,
            "recordsFiltered" => $numberOfFilteredRows,
            "data" => $data
        );

        return response()->json($output);
    }

    private function getTrashedTestimonials($draw, $searchParameter, $orderBy, $start, $length)
    {
        $filteredData = Testimonial::onlyTrashed()->latest()->search($searchParameter)->order($orderBy)->limitBy($start, $length)->get();
        $numberOfTotalRows = Testimonial::onlyTrashed()->latest()->count();
        $numberOfFilteredRows = Testimonial::onlyTrashed()->latest()->search($searchParameter)->get()->count();
        $data = array();
        for ($i = 0; $i < sizeof($filteredData); $i++) {
            $subarray = [];
            $subarray[] = $i + 1 + $start;
            $subarray[] =
                <<<IMAGE
    <img src="storage/{$filteredData[$i]->image}" class="rounded-circle" alt="User Image" width="100px"/>
IMAGE;
            $subarray[] = e((string) ($filteredData[$i]->name));
            $subarray[] = e((string) ($filteredData[$i]->city));
            $subarray[] = e((string) ($filteredData[$i]->truncated_testimonial));
            $subarray[] = $this->getTrashedTestimonialActionButtons($filteredData[$i]);
            $data[] = $subarray;
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $numberOfTotalRows,
            "recordsFiltered" => $numberOfFilteredRows,
            "data" => $data
        );

        return response()->json($output);
    }

    /*
     * This method is only for action buttons for testimonials
     */
    private function getTrashedTestimonialActionButtons($testimonial)
    {
        $actionButtons = "<div class='d-flex align-items-center justify-content-center'>";
        if (auth()->user()->can('restore', $testimonial)) {
            $actionButtons .= "
                        <a class='btn btn-label-success btn-bold btn-sm m-1 d-flex' href='#' onclick='displayRestoreModalForm(" . $testimonial->id . ")'
                        data-toggle='modal'
                        data-target='#restoreModal'>
                            <i class='kt-menu__link-icon flaticon-refresh'></i>
                            Restore
                        </a>";
        }
        if (auth()->user()->can('forceDelete', $testimonial)) {
            $actionButtons .= "<a href='#' class='btn btn-label-danger btn-bold btn-sm m-1 d-flex'
                        onclick='displayDeleteModalForm(" . $testimonial->id . ")'
                        data-toggle='modal'
                        data-target='#deleteModal'><i class='kt-menu__link-icon flaticon2-trash'></i>Delete</a>";
        }
        return $actionButtons . "</div>";
    }

    private function getPropertiesActionButton($property){
        $actionButtons = "<div class='d-flex align-items-center justify-content-center'>";
        if (auth()->user()->can('view', $property)){
            $actionButtons .= "<a href='" . route('frontend.single-property', $property->slug) . "' class='btn btn-label btn-label-success btn-sm btn-bold m-1 d-flex'><i class='kt-menu__link-icon la la-eye'></i>View</a>";
        }
        if (auth()->user()->can('update', $property)) {
            $actionButtons .= "<a href='" . route('properties.edit', $property->id) . "' class='btn btn-label btn-label-primary btn-sm btn-bold m-1 d-flex'><i class='kt-menu__link-icon flaticon-edit'></i>Edit</a>";
        }
        if (auth()->user()->can('delete', $property)) {
            $actionButtons .= "<a href='#' class='btn btn-label btn-label-danger btn-bold btn-sm m-1 d-flex' data-toggle='modal' onclick='displayTrashModalForm(" . $property->id . ")' data-target='#deleteModal'><i class='kt-menu__link-icon flaticon2-trash'></i>Trash</a>";
        }
        return $actionButtons . '</div>';
    }

    private function getProperties($draw, $search_parameter, $order_by, $start, $length){
        $filteredData = Property::withoutTrashed()->joinTables()->filter()->search($search_parameter)->order($order_by)->limitby($start, $length)->get();

        $numberOfTotalRows = Property::withoutTrashed()->joinTables()->filter()->count();

        $numberOfFilteredRows = Property::withoutTrashed()->joinTables()->filter()->search($search_parameter)->get()->count();

        $data = array();

        for ($i = 0; $i < sizeof($filteredData); $i++) {
            $status = $filteredData[$i]->status;
            $type = $filteredData[$i]->type;
            $cssClass = lcfirst($status);

            $subarray = [];
            $subarray[] = $i + 1 + $start;
            $subarray[] = <<<IMAGE
            <img src="storage/{$filteredData[$i]->feature_image_path}" alt="Feature Image" width="100px"/>
IMAGE;
            $subarray[] = "<span class='badge badge-" . e($cssClass) . "'>" . e($status) . "</span>";

            $cssClass = lcfirst($type);

            $subarray[] = "<span class='badge badge-" . e($cssClass) . "'>" . e($type) . "</span>";
            $subarray[] = e((string) ($filteredData[$i]->owner_name));
            $subarray[] = e((string) ($filteredData[$i]->carpet));
            $subarray[] = e((string) ($filteredData[$i]->property_address));
            $subarray[] = e((string) ($filteredData[$i]->under_construction == 1 ? 'Under Construction' : 'Ready to move'));
            $subarray[] = e((string) ($filteredData[$i]->age_of_property));
            $subarray[] = $this->getPropertiesActionButton($filteredData[$i]);

            $data[] = $subarray;
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $numberOfTotalRows,
            "recordsFiltered" => $numberOfFilteredRows,
            "data" => $data
        );

        return response()->json($output);
    }

    private function getTrashedProperties($draw, $searchParameter, $orderBy, $start, $length) {
        $filteredData = Property::onlyTrashed()->joinTables()->filter()->search($searchParameter)->order($orderBy)->limitby($start, $length)->get();

        $numberOfTotalRows = Property::onlyTrashed()->joinTables()->filter()->count();

        $numberOfFilteredRows = Property::onlyTrashed()->joinTables()->filter()->search($searchParameter)->get()->count();

        $data = array();

        for ($i = 0; $i < sizeof($filteredData); $i++) {
            $status = $filteredData[$i]->status;
            $type = $filteredData[$i]->type;
            $cssClass = lcfirst($status);

            $subarray = [];
            $subarray[] = $i + 1 + $start;
            $subarray[] = <<<IMAGE
            <img src="storage/{$filteredData[$i]->feature_image_path}" alt="Feature Image" width="100px"/>
IMAGE;
            $subarray[] = "<span class='badge badge-" . e($cssClass) . "'>" . e($status) . "</span>";

            $cssClass = lcfirst($type);

            $subarray[] = "<span class='badge badge-" . e($cssClass) . "'>" . e($type) . "</span>";
            $subarray[] = e((string) ($filteredData[$i]->owner_name));
            $subarray[] = e((string) ($filteredData[$i]->carpet));
            $subarray[] = e((string) ($filteredData[$i]->property_address));
            $subarray[] = e((string) ($filteredData[$i]->under_construction == 1 ? 'Under Construction' : 'Ready to move'));
            $subarray[] = e((string) ($filteredData[$i]->age_of_property));
            $subarray[] = $this->getTrashedPropertyActionButtons($filteredData[$i]);

            $data[] = $subarray;
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $numberOfTotalRows,
            "recordsFiltered" => $numberOfFilteredRows,
            "data" => $data
        );

        return response()->json($output);
    }

    private function getTrashedPropertyActionButtons($property){
        $actionButtons = "<div class='d-flex align-items-center justify-content-center'>";
        if (auth()->user()->can('restore', $property)) {
            $actionButtons .= "
                        <a class='btn btn-label-success btn-bold btn-sm m-1 d-flex' href='#' onclick='displayRestoreModalForm(" . $property->id . ")'
                        data-toggle='modal'
                        data-target='#restoreModal'>
                            <i class='kt-menu__link-icon flaticon-refresh'></i>
                            Restore
                        </a>";
        }
        if (auth()->user()->can('forceDelete', $property)) {
            $actionButtons .= "<a href='#' class='btn btn-label-danger btn-bold btn-sm m-1 d-flex'
                        onclick='displayDeleteModalForm(" . $property->id . ")'
                        data-toggle='modal'
                        data-target='#deleteModal'><i class='kt-menu__link-icon flaticon2-trash'></i>Delete</a>";
        }
        return $actionButtons . "</div>";
    }

    /**
     * This methods are used for FRE
     */

    private function getFRE($draw, $search_parameter, $order_by, $start, $length){
        $filteredData = FRE::withoutTrashed()->joinTables()->search($search_parameter)->order($order_by)->limitBy($start, $length)->get();
        $numberOfTotalRows = FRE::withoutTrashed()->count();
        $numberOfFilteredRows = FRE::withoutTrashed()->joinTables()->search($search_parameter)->get()->count();
        $data = array();
        for ($i = 0; $i < sizeof($filteredData); $i++) {
            $subarray = [];
            $subarray[] = $i + 1 + $start;
            $subarray[] = <<<IMAGE
            <img src="storage/{$filteredData[$i]->feature_image_path}" class="" alt="FRE Image" width="150px"/>
IMAGE;
            $subarray[] = e((string) ($filteredData[$i]->title));
            $subarray[] = e((string) ($filteredData[$i]->fre_address));
            $subarray[] = e((string) ($filteredData[$i]->developer->name));
            $subarray[] = e((string) ($filteredData[$i]->total_price));
            $subarray[] = e((string) ($filteredData[$i]->possesion_date));
            $subarray[] = $this->getFREActionButtons($filteredData[$i]);
            $data[] = $subarray;
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $numberOfTotalRows,
            "recordsFiltered" => $numberOfFilteredRows,
            "data" => $data
        );

        return response()->json($output);

    }

    private function getFREActionButtons($fre) {
        $actionButtons = "<div class='d-flex align-items-center justify-content-center'>";
        if (auth()->user()->can('view', $fre)){
            $actionButtons .= "<a href='" . route('frontend.single-fre', $fre->slug) . "' class='btn btn-label btn-label-success btn-sm btn-bold m-1 d-flex'><i class='kt-menu__link-icon la la-eye'></i>View</a>";
        }
        if (auth()->user()->can('update', $fre)) {
            $actionButtons .= "<a href='" . route('fre.edit', $fre->id) . "' class='btn btn-label btn-label-primary btn-sm btn-bold m-1 d-flex'><i class='kt-menu__link-icon flaticon-edit'></i>Edit</a>";
        }
        if (auth()->user()->can('delete', $fre)) {
            $actionButtons .= "<a href='#' class='btn btn-label btn-label-danger btn-bold btn-sm m-1 d-flex' data-toggle='modal' onclick='displayTrashModalForm(" . $fre->id . ")' data-target='#deleteModal'><i class='kt-menu__link-icon flaticon2-trash'></i>Trash</a>";
        }
      
        return $actionButtons . '</div>';
    }

    private function getTrashedFRE($draw, $search_parameter, $orderBy, $start, $length){
        $filteredData = FRE::onlyTrashed()->search($search_parameter)->order($orderBy)->limitBy($start, $length)->get();
        $numberOfTotalRows = FRE::onlyTrashed()->count();
        $numberOfFilteredRows = FRE::onlyTrashed()->search($search_parameter)->get()->count();
        $data = array();
        for ($i = 0; $i < sizeof($filteredData); $i++) {
            $subarray = [];
            $subarray[] = $i + 1 + $start;
            $subarray[] = <<<IMAGE
            <img src="storage/{$filteredData[$i]->feature_image_path}" class="" alt="FRE Image" width="150px"/>
IMAGE;
            $subarray[] = e((string) ($filteredData[$i]->title));
            $subarray[] = e((string) ($filteredData[$i]->fre_address));
            $subarray[] = e((string) ($filteredData[$i]->total_price));
            $subarray[] = e((string) ($filteredData[$i]->possesion_date));
            $subarray[] = $this->getTrashedFREActionButtons($filteredData[$i]);
            $data[] = $subarray;
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $numberOfTotalRows,
            "recordsFiltered" => $numberOfFilteredRows,
            "data" => $data
        );

        return response()->json($output);

    }

    private function getTrashedFREActionButtons($fre){
        $actionButtons = "<div class='d-flex align-items-center justify-content-center'>";
        if (auth()->user()->can('restore', $fre)) {
            $actionButtons .= "
                        <a class='btn btn-label-success btn-bold btn-sm m-1 d-flex' href='#' onclick='displayRestoreModalForm(" . $fre->id . ")'
                        data-toggle='modal'
                        data-target='#restoreModal'>
                            <i class='kt-menu__link-icon flaticon-refresh'></i>
                            Restore
                        </a>";
        }
        if (auth()->user()->can('forceDelete', $fre)) {
            $actionButtons .= "<a href='#' class='btn btn-label-danger btn-bold btn-sm m-1 d-flex'
                        onclick='displayDeleteModalForm(" . $fre->id . ")'
                        data-toggle='modal'
                        data-target='#deleteModal'><i class='kt-menu__link-icon flaticon2-trash'></i>Delete</a>";
        }
        return $actionButtons . "</div>";
    }

    private function getEnquiries($draw, $searchParameter, $orderBy, $start, $length)
    {
        $filteredData = Enquiry::withoutTrashed()->joinAllRelatedTables()->search($searchParameter)->order($orderBy)->limitBy($start, $length)->get();
        // dd($filteredData);
        $numberOfTotalRows = Enquiry::withoutTrashed()->count();
        $numberOfFilteredRows = Enquiry::withoutTrashed()->joinAllRelatedTables()->search($searchParameter)->get()->count();
        $data = array();
        for ($i = 0; $i < sizeof($filteredData); $i++) {
            $subarray = [];
            $subarray[] = $i + 1 + $start;
            $subarray[] = e((string) ($filteredData[$i]->name));
            $subarray[] = e((string) ($filteredData[$i]->email));
            $subarray[] = e((string) ($filteredData[$i]->phone_number));
            $subarray[] = e((string) ($filteredData[$i]->source));
            $subarray[] = e((string) ($filteredData[$i]->property_address ? $filteredData[$i]->property_address : ($filteredData[$i]->fre_address ? $filteredData[$i]->fre_address : '')));

            $subarray[] = e((string) ($filteredData[$i]->message));
            $subarray[] = $this->getGeneralActionButtons($filteredData[$i]);

            $data[] = $subarray;
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $numberOfTotalRows,
            "recordsFiltered" => $numberOfFilteredRows,
            "data" => $data
        );

        return response()->json($output);
    }

    private function getTrashedEnquiries($draw, $searchParameter, $orderBy, $start, $length)
    {
        $filteredData = Enquiry::onlyTrashed()->joinAllRelatedTables()->limitBy($start, $length)->get();
        $numberOfTotalRows = Enquiry::onlyTrashed()->count();
        $numberOfFilteredRows = Enquiry::onlyTrashed()->joinAllRelatedTables()->limitBy($start, $length)->get()->count();
        $data = array();
        for ($i = 0; $i < sizeof($filteredData); $i++) {
            $subarray = [];
            $subarray[] = $i + 1 + $start;
            $subarray[] = e((string) ($filteredData[$i]->name));
            $subarray[] = e((string) ($filteredData[$i]->email));
            $subarray[] = e((string) ($filteredData[$i]->phone_number));
            $subarray[] = e((string) ($filteredData[$i]->model));
            $subarray[] = e((string) ($filteredData[$i]->building_name));
            $subarray[] = e((string) ($filteredData[$i]->message));
            $subarray[] = $this->getGeneralTrashedActionButtons($filteredData[$i]);

            $data[] = $subarray;
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $numberOfTotalRows,
            "recordsFiltered" => $numberOfFilteredRows,
            "data" => $data
        );

        return response()->json($output);
    }

    private function getDashboard($type)
    {
        if($type == "rent_sell")
        {
            $data = array();
            $rentCount = Property::withoutTrashed()->rentProperty()->get()->count();
            $sellCount = Property::withoutTrashed()->sellProperty()->get()->count();
            $totalCount = $rentCount + $sellCount;

            $rentPercentage = round(($rentCount/$totalCount) * 100);
            $sellPercentage = 100 - $rentPercentage;

            $data[] = ['label'=>'Rent', 'data'=> $rentPercentage];
            $data[] = ['label'=>'Sell', 'data'=> $sellPercentage];
            // dd($data);

            return response()->json($data);
        }else if($type == "residential_commercial"){
            $data = array();
            $rentCount = Property::withoutTrashed()->residentialProperty()->get()->count();
            $sellCount = Property::withoutTrashed()->commercialProperty()->get()->count();
            $totalCount = $rentCount + $sellCount;

            $rentPercentage = round(($rentCount/$totalCount) * 100);
            $sellPercentage = 100 - $rentPercentage;

            $data[] = ['label'=>'Residential', 'data'=> $rentPercentage];
            $data[] = ['label'=>'Commercial', 'data'=> $sellPercentage];
            // dd($data);

            return response()->json($data);
        }else if($type == "current_year_property"){
            $propetiesData = Property::withoutTrashed()->propertyOfCurrentYear();
            $propertyDataCount = count(Property::withoutTrashed()->propertyOfCurrentYear());

            $data = array();

            $monthCount = 1;
            for($index = 0; $index<12; $index++){
                $count = 0;
                for($propertyIndex = 0; $propertyIndex<$propertyDataCount; $propertyIndex++){
                    if($monthCount == ((int)($propetiesData[$propertyIndex]->month)))
                    {
                        $count = $propetiesData[$propertyIndex]->count;
                        break;
                    }
                } 
                $data[] = [$index, $count];
                $monthCount++;
            }
            return response()->json($data);
        }else if($type == "current_year_fre"){
            $freData = FRE::withoutTrashed()->freOfCurrentYear();
            $freDataCount = count(FRE::withoutTrashed()->freOfCurrentYear());

            $data = array();

            $monthCount = 1;
            for($index = 0; $index<12; $index++){
                $count = 0;
                for($freIndex = 0; $freIndex<$freDataCount; $freIndex++){
                    if($monthCount == ((int)($freData[$freIndex]->month)))
                    {
                        $count = $freData[$freIndex]->count;
                        break;
                    }
                } 
                $data[] = [$index, $count];
                $monthCount++;
            }
            return response()->json($data);
        }
    }

}