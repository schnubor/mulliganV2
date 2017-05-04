<template>
    <canvas id="cardtypes"></canvas>
</template>

<script>
    import Chart from 'chart.js';

    export default {
        data() {
            return {
                options : {
                    legend : { display : false }
                }
            };
        },
        computed : {
            chartData() {
                return [
                    this.$store.getters.creatureCount,
                    this.$store.getters.instantCount,
                    this.$store.getters.sorceryCount,
                    this.$store.getters.enchantmentCount,
                    this.$store.getters.planeswalkerCount,
                    this.$store.getters.artifactCount,
                    this.$store.getters.landCount,
                    this.$store.getters.basiclandCount
                ];
            }
        },
        mounted() {
            const options = this.options;

            const ctx = document.getElementById( 'cardtypes' );
            new Chart( ctx, {
                type    : 'pie',
                data    : {
                    labels : [
                        'Creatures',
                        'Instants',
                        'Sorceries',
                        'Enchantments',
                        'Planeswalker',
                        'Artifacts',
                        'Lands',
                        'Basiclands'
                    ],
                    datasets : [
                        {
                            data                    : this.chartData,
                            backgroundColor         : [
                                '#37a0e1',
                                '#37e1c0',
                                '#4cff95',
                                '#e1ba37',
                                '#ff824c',
                                '#b2b2b2',
                                '#7c6b64',
                                '#473730'
                            ],
                            hoverBackgroundColor    : [
                                '#2e86bd',
                                '#2ebba0',
                                '#49d984',
                                '#b2932c',
                                '#c9683e',
                                '#8a8a8a',
                                '#665953',
                                '#33251f'
                            ]
                        }
                    ]
                },
                options : options
            } );
        }
    };
</script>
