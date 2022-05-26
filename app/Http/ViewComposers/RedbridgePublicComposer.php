<?php
/**
 * Created by PhpStorm.
 * User: speekadievs
 * Date: 02/11/2017
 * Time: 16:19
 */

namespace app\Http\ViewComposers;


use Illuminate\View\View;
use Modules\Admin\Models\Menu;

class RedbridgePublicComposer
{

    protected $header;

    protected $firstFooter;

    protected $secondFooter;

    /**
     * RedbridgePublicComposer constructor.
     */
    public function __construct()
    {
        $menus = Menu::where('type', 'public')->get();

        $this->header = $menus->where('name', 'clientHeader')->first()
            ->items()
            ->active()
            ->where('is_active', 1)
            ->defaultOrder()
            ->get();

        $this->firstFooter = $menus->where('name', 'clientFooterFirst')->first()
            ->items()
            ->active()
            ->where('is_active', 1)
            ->defaultOrder()
            ->get();

        $this->secondFooter = $menus->where('name', 'clientFooterSecond')->first()
            ->items()
            ->active()
            ->where('is_active', 1)
            ->defaultOrder()
            ->get();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with([
            'header' => $this->header,
            'firstFooter' => $this->firstFooter,
            'secondFooter' => $this->secondFooter
        ]);
    }
}