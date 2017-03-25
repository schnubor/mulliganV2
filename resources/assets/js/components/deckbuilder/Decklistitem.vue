<template>
    <li>
        <a>
            <span class="tag is-warning">{{ quantity }}</span>
            {{ entry.name }}
        </a>
        <ul v-show="showSubmenu">
            <li>
                <a>Card Details</a>
            </li>
            <li>
                <a>Remove one</a>
            </li>
        </ul>
    </li>
</template>

<script>
    import Store from './store.js';
    import _ from 'lodash';

    export default {
        props : [ 'entry' ],
        data() {
            return {
                showSubmenu : false,
                shared      : Store
            };
        },
        computed : {
            quantity() {
                const cardIndex = _.findIndex( this.shared.decklist.creatures, { 'id' : this.entry.id } );
                return this.shared.decklist.creatures[ cardIndex ].qty;
            }
        }
    };
</script>
