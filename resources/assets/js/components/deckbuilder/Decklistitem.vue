<template>
    <li>
        <a>
            <span class="tag" :class="[fullClass, errorClass]">{{ entry.qty }}</span>
            {{ entry.card.name }}
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
                showSubmenu : false
            };
        },
        computed : {
            fullClass() {
                if ( this.entry.qty === 4 &&
                     _.get( this.entry.card, 'supertypes[0]' ) !== 'Basic' ) {
                    return 'is-warning';
                }
                return '';
            },
            errorClass() {
                if ( this.entry.qty > 4 &&
                     _.get( this.entry.card, 'supertypes[0]' ) !== 'Basic' ) {
                    return 'is-danger';
                }
                return '';
            }
        }
    };
</script>
