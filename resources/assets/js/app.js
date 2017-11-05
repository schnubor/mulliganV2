import Vue from 'vue';
import VTooltip from 'v-tooltip';

// Views
import Quicksearch from './components/quicksearch/Quicksearch.vue';
import Deckbuilder from './components/deckbuilder/Deckbuilder.vue';
import Deck from './components/deck/Singledeck.vue';
import Deckactions from './components/deck/Deckactions.vue';

import { store } from './vuex/store.js';

Vue.use( VTooltip );

new Vue( {
    el          : '#app',
    store       : store,
    components  : {
        Quicksearch,
        Deckbuilder,
        Deck,
        Deckactions
    }
} );

// Mobile Navigation
document.addEventListener( 'DOMContentLoaded', function() {
    // Get all "navbar-burger" elements
    var $navbarBurgers = Array.prototype.slice.call( document.querySelectorAll( '.navbar-burger' ), 0 );

    // Check if there are any navbar burgers
    if ( $navbarBurgers.length > 0 ) {
        // Add a click event on each of them
        $navbarBurgers.forEach( function( $el ) {
            $el.addEventListener( 'click', function() {
                // Get the target from the "data-target" attribute
                var target = $el.dataset.target;
                var $target = document.getElementById( target );

                // Toggle the class on both the "navbar-burger" and the "navbar-menu"
                $el.classList.toggle( 'is-active' );
                $target.classList.toggle( 'is-active' );
            } );
        } );
    }
} );
