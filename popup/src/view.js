/**
 * WordPress dependencies
 */
import { store, getContext } from '@wordpress/interactivity';

import './view.scss';

/**
 * Registers the interactivity store
 * 
 * Here we define actions (such as when we click the toggle button) and callback
 * events which let us perform other actions when the store changes.
 */
store( 'create-block', {
	actions: {
		toggle: () => {
			const context = getContext();
			context.isOpen = ! context.isOpen;
			state
		},
	},
	callbacks: {
		logIsOpen: () => {
			const { isOpen } = getContext();
			// Log the value of `isOpen` each time it changes.
			console.log( `Is open: ${ isOpen }` );
		},
	},
} );
