<template>
    <div>

        <span class="tag is-primary is-large">60 Cards</span>
        
        <aside class="menu" style="margin-top: 1.5em;">
            <p class="menu-label">
                Creatures
            </p>
            <ul class="menu-list">
                <li><a><span class="tag is-primary">4</span> Veteran Motorist</a></li>
                <li><a><span class="tag">1</span> Gideon</a></li>
            </ul>
            <p class="menu-label">
                Enchantments
            </p>
            <ul class="menu-list">
                <li><a>Team Settings</a></li>
                <li><a>Invitations</a></li>
                <li><a>Cloud Storage </a></li>
                <li><a>Authentication</a></li>
            </ul>
            <p class="menu-label">
                Artifacts
            </p>
            <ul class="menu-list">
                <li><a>Payments</a></li>
                <li><a>Transfers</a></li>
                <li><a>Balance</a></li>
            </ul>
            <p class="menu-label">
                Lands
            </p>
            <ul class="menu-list">
                <li><a><span class="tag">14</span> Plains</a></li>
                <li><a>Transfers</a></li>
                <li><a>Balance</a></li>
            </ul>
        </aside>
    </div>
</template>

<script>
    import Spinner from './Spinner.vue';

    export default {
        data() {
            return {};
        },
        components : {
            Spinner
        }
    };
</script>

<style lang="scss">
    
</style>