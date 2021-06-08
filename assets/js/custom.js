'use strict';

( function() {
	var container, button, menu, links, i, len;

	container = document.getElementById( 'primary-nav' );

	if ( ! container ) {
		return;
	}

	button = container.getElementsByTagName( 'button' )[0];

	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );

	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};

	links = menu.getElementsByTagName( 'a' );

	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	function toggleFocus() {
		var self = this;

		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}

	( function( container ) {
		var touchStartFn,
			i,
			parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

		if ( 'ontouchstart' in window ) {
			touchStartFn = function touchStartFn( event ) {
				var menuItem = this.parentNode,
					i;

				if ( ! menuItem.classList.contains( 'focus' ) ) {
					event.preventDefault();

					for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
						if ( menuItem === menuItem.parentNode.children[i]) {
							continue;
						}

						menuItem.parentNode.children[i].classList.remove( 'focus' );
					}

					menuItem.classList.add( 'focus' );
				} else {
					menuItem.classList.remove( 'focus' );

					if ( '#' === this.getAttribute( 'href' ) ) {
						event.preventDefault();
					}
				}
			};

			for ( i = 0; i < parentLink.length; ++i ) {
				parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
			}
		}
	}( container ) );

	document.addEventListener( 'click', function( event ) {
		var link;

		if ( ! event.target.closest( '.menu-item' ) ) {
			for ( i = 0, len = links.length; i < len; i++ ) {
				links[i].parentNode.classList.remove( 'focus' );
			}
		}

		if ( event.target.closest( '.menu-item a' ) ) {
			if ( event.target.hasAttribute( 'href' ) ) {
				link = event.target;
			} else {
				link = event.target.parentNode;
			}

			if ( '#' === link.getAttribute( 'href' ) ) {
				event.preventDefault();
			}
		}
	}, false );
}() );
'use strict';

( function() {
	function scrollToTop() {
		var element = document.querySelector( 'body' ).offsetTop;

		window.scroll({
			top: element,
			left: 0,
			behavior: 'smooth'
		});
	}

	function scrollClasses() {
		var topButton = document.querySelector( '.to-top' );

		if ( 100 < document.body.scrollTop || 100 < document.documentElement.scrollTop ) {
			topButton.style.display = 'block';
		} else {
			topButton.style.display = 'none';
		}
	}

	scrollClasses();
	document.querySelector( '.to-top' ).addEventListener( 'click', scrollToTop, false );

	window.onscroll = function() {
		scrollClasses();
	};
}() );
'use strict';

( function() {
	var isIe = /(trident|msie)/i.test( navigator.userAgent );

	if ( isIe && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! /^[A-z0-9_-]+$/.test( id ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
}() );
