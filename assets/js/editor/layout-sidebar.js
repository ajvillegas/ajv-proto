/**
 * Custom 'Layout Settings' sidebar plugin.
 *
 * @package    AJV_Proto
 * @author     Alexis J. Villegas
 * @link       http://www.alexisvillegas.com
 * @license    GPL-2.0+
 */

wp.domReady( () => {

	// Add sidebar plugin.
	const el = wp.element.createElement;
	const Fragment = wp.element.Fragment;
	const PluginSidebar = wp.editPost.PluginSidebar;
	const PluginSidebarMoreMenuItem = wp.editPost.PluginSidebarMoreMenuItem;
	const registerPlugin = wp.plugins.registerPlugin;
	const moreIcon = 'layout';

	function Component() {
		return el(
			Fragment,
			{},
			el(
				PluginSidebarMoreMenuItem,
				{
					target: 'sidebar-name'
				},
				'Layout Settings'
			),
			el(
				PluginSidebar,
				{
					name: 'sidebar-name',
					title: 'Layout Settings'
				},
				'Content of the sidebar'
			)
		);
	}
	registerPlugin( 'plugin-name', {
		icon: moreIcon,
		render: Component
	});
});
