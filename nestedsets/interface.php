<?php
/**
*
* @package phpBB Gallery Core
* @copyright (c) 2013 nickvergessen
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

interface phpbb_ext_gallery_core_nestedsets_interface
{
	/**
	* Move an item by a given delta
	*
	* @param phpbb_ext_gallery_core_nestedsets_item_interface	$item	The item to be moved
	* @param int	$delta	Number of steps to move this item, < 0 => down, > 0 => up
	* @return bool True if the item was moved
	*/
	public function move(phpbb_ext_gallery_core_nestedsets_item_interface $item, $delta);

	/**
	* Move an item down by 1
	*
	* @param phpbb_ext_gallery_core_nestedsets_item_interface	$item	The item to be moved
	* @return bool True if the item was moved
	*/
	public function move_down(phpbb_ext_gallery_core_nestedsets_item_interface $item);

	/**
	* Move an item up by 1
	*
	* @param phpbb_ext_gallery_core_nestedsets_item_interface	$item	The item to be moved
	* @return bool True if the item was moved
	*/
	public function move_up(phpbb_ext_gallery_core_nestedsets_item_interface $item);

	/**
	* Add an item at the end of the nested set
	*
	* @param phpbb_ext_gallery_core_nestedsets_item_interface	$item	The item to be added
	* @return bool True if the item was added
	*/
	public function add(phpbb_ext_gallery_core_nestedsets_item_interface $item);

	/**
	* Remove an item from the nested set
	*
	* Also removes all subitems from the nested set
	*
	* @param phpbb_ext_gallery_core_nestedsets_item_interface	$item	The item to be removed
	* @return bool True if the item was removed
	*/
	public function remove(phpbb_ext_gallery_core_nestedsets_item_interface $item);

	/**
	* Delete an item from the nested set (also deletes the rows form the table)
	*
	* Also deletes all subitems from the nested set
	*
	* @param phpbb_ext_gallery_core_nestedsets_item_interface	$item	The item to be deleted
	* @return bool True if the item was deleted
	*/
	public function delete(phpbb_ext_gallery_core_nestedsets_item_interface $item);

	/**
	* Moves all children of one item to another item
	*
	* @param phpbb_ext_gallery_core_nestedsets_item_interface	$current_parent		The current parent item
	* @param phpbb_ext_gallery_core_nestedsets_item_interface	$new_parent			The new parent item
	* @return bool True if any items where moved
	*/
	public function move_children(phpbb_ext_gallery_core_nestedsets_item_interface $current_parent, phpbb_ext_gallery_core_nestedsets_item_interface $new_parent);

	/**
	* Add an item as child of a given parent
	*
	* @param phpbb_ext_gallery_core_nestedsets_item_interface	$new_parent		The parent item
	* @param phpbb_ext_gallery_core_nestedsets_item_interface	$item			The item to be added
	* @return bool True if the item was added
	*/
	public function add_child(phpbb_ext_gallery_core_nestedsets_item_interface $new_parent, phpbb_ext_gallery_core_nestedsets_item_interface $item);

	/**
	* Delete an item from the nested set
	*
	* @param phpbb_ext_gallery_core_nestedsets_item_interface	$item		The item to be moved
	* @param phpbb_ext_gallery_core_nestedsets_item_interface	$new_parent	The new parent item
	* @return bool True if the item was deleted
	*/
	public function change_parent(phpbb_ext_gallery_core_nestedsets_item_interface $item, phpbb_ext_gallery_core_nestedsets_item_interface $new_parent);

	/**
	* Get branch of the item
	*
	* This method can return all parents, children or both of the given item
	*
	* @param phpbb_ext_gallery_core_nestedsets_item_interface	$item		The item to get the branch from
	* @param string		$type			One of all|parent|children
	* @param bool		$order_desc		Order the items descending (most outer parent first)
	* @param bool		$include_item	Should the given item be included in the list aswell
	* @return array			Array of items (containing all columns from the item table)
	*							ID => Item data
	*/
	public function get_branch_data(phpbb_ext_gallery_core_nestedsets_item_interface $item, $type, $order_desc, $include_item);

	/**
	* Get base information of parent items
	*
	* @param phpbb_ext_gallery_core_nestedsets_item_interface	$item		The item to get the parents from
	* @return array			Array of items (containing basic columns from the item table)
	*							ID => Item data
	*/
	public function get_parent_data(phpbb_ext_gallery_core_nestedsets_item_interface $item);
}