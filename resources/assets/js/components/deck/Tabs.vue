<template>
    <section class="section">
        <div class="container">
            <div class="tabs">
                <ul>
                    <li :class="{ 'is-active' : activeTab === 'decklist' }"><a @click="changeTab('decklist')">Decklist</a></li>
                    <li :class="{ 'is-active' : activeTab === 'stats' }"><a @click="changeTab('stats')">Statistics</a></li>
                    <li :class="{ 'is-active' : activeTab === 'hand' }"><a @click="changeTab('hand')">Start Hand</a></li>
                </ul>
            </div>
                
            <Decklist v-if="activeTab === 'decklist'"></Decklist>
            <Stats v-if="activeTab === 'stats'"></Stats>
        </div>
    </section>
</template>

<script>
import Decklist from './tabs/Decklist.vue';
import Stats from './tabs/Stats.vue';

export default {
    components : {
        Decklist,
        Stats
    },
    data() {
        return {
            activeTab : 'decklist'
        };
    },
    methods : {
        changeTab( tab ) {
            this.activeTab = tab;
        }
    }
};
</script>

