<template>
    <li>
        <a>
            <span class="tag is-warning">{{ entry.qty }}</span>
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
        }
    };
</script>
