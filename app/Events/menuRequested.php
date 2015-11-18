<?php namespace Plans\Events;

use Illuminate\Support\Facades\Request;
use Illuminate\Queue\SerializesModels;

class menuRequested extends Event {

	use SerializesModels;

	protected $items;
	protected $current;
	protected $currentKey;
	protected $has_children;

	public function __construct() {
		$this->current = Request::url();
	}

	/*
     * Shortcut method for create a menu with a callback.
     * This will allow you to do things like fire an even on creation.
     *
     * @param callable $callback Callback to use after the menu creation
     * @return object
     */
	public static function create($callback) {
		$menu = new menuRequested;
		$callback($menu);
		$menu->sortItems();

		return $menu;
	}

	/*
     * Add a menu item to the item stack
     *
     * @param string $key Dot separated hierarchy
     * @param string $name Text for the anchor
     * @param string $url URL for the anchor
     * @param integer $sort Sorting index for the items
     * @param string $icon URL to use for the icon
     */
	public function add($key, $name, $url, $sort = 0, $icon = null)
	{
		$item = array(
			'key'       => $key,
			'name'      => $name,
			'url'       => $url,
			'sort'      => $sort,
			'icon'      => $icon,
			'children'  => array()
		);

		$children = str_replace('.', '.children.', $key);
		array_set($this->items, $children, $item);

		if($url == $this->current) {
			$this->currentKey = $key;
		}
	}

	/*
     * Recursive function to loop through items and create a menu
     *
     * @param array $items List of items that need to be rendered
     * @param boolean $level Which level you are currently rendering
     * @return string
     */
	public function render($items = null, $level = 1)
	{
		$items = $items ?: $this->items;

		$attr = array(
			'id' => 1 === $level ? 'nav' : '',
			'class' => 1 === $level ? '' : 'sub-menu'
		);

		$menu = '<ul' . \HTML::attributes($attr) . '>';

		foreach($items as $item) {
			$classes = array('');
			$classes[] = $this->getActive($item);

			$this->has_children = sizeof($item['children']);

			if ($this->has_children) {
				$classes[] = '';
			}

			$menu .= '<li' . \HTML::attributes(array('class' => trim(implode(' ', $classes)))) . '>';
			$menu .= $this->createAnchor($item);
			$menu .= ($this->has_children) ? $this->render($item['children'], ++$level) : '';
			$menu .= '</li>';
		}

		$menu .= '</ul>';
		return $menu;
	}

	/*
     * Method to render an anchor
     *
     * @param array $item Item that needs to be turned into a link
     * @return string
     */
	private function createAnchor($item)
	{
		$output = '<a href="' . $item['url'] . '">';
		$output .= $this->createIcon($item);
		$output .= $item['name'];
		if ($this->has_children > 0 ? $output .= "<span class='label label-info pull-right'>$this->has_children</span>" : $output .= '<span></span>');
		$output .= '</a>';

		return $output;
	}

	/*
     * Method to render an icon
     *
     * @param array $item Item that needs to be turned into a icon
     * @return string
     */
	private function createIcon($item)
	{
		$output = '';

		if($item['icon']) {
			$output .= sprintf(
				'<i class="fa fa-%s"></i> ',
				$item['icon']
			);
		}

		return $output;
	}

	/*
     * Method to sort through the menu items and put them in order
     *
     * @return void
     */
	private function sortItems() {
		usort($this->items, function($a, $b) {
			if($a['sort'] == $b['sort']) {
				return 0;
			}

			return ($a['sort'] < $b['sort'] ? -1 : 1);
		});
	}

	/*
     * Method to find the active links
     *
     * @param array $item Item that needs to be checked if active
     * @return string
     */
	private function getActive($item)
	{
		$url = trim($item['url'], '/');

		if ($this->current === $url)
		{
			return 'active';
		}

		if(strpos($this->currentKey, $item['key']) === 0) {
			return 'current';
		}
	}


}
