<template>
    <canvas id="manacurve"></canvas>
</template>

<script>
    import Chart from 'chart.js';

    export default {
        props : [ 'decklist' ],
        mounted() {
            const ctx = document.getElementById( 'manacurve' );
            new Chart( ctx, {
                type    : 'bar',
                data    : {
                    labels   : [ 'CMC 0', 'CMC 1', 'CMC 2', 'CMC 3', 'CMC 4', 'CMC 5+' ],
                    datasets : [
                        {
                            label                   : 'Creatures',
                            data                    : this.creaturesData,
                            backgroundColor         : '#37a0e1',
                            hoverBackgroundColor    : '#2e86bd',
                            hoverBorderWidth        : 0,
                            hoverBorderColor        : 'lightgrey',
                            stack                   : 1
                        },
                        {
                            label                   : 'Instants',
                            data                    : this.instantsData,
                            backgroundColor         : '#37e1c0',
                            hoverBackgroundColor    : '#2ebba0',
                            hoverBorderWidth        : 0,
                            stack                   : 1
                        },
                        {
                            label                   : 'Sorceries',
                            data                    : this.sorceriesData,
                            backgroundColor         : '#4cff95',
                            hoverBackgroundColor    : '#49d984',
                            hoverBorderWidth        : 0,
                            stack                   : 1
                        },
                        {
                            label                   : 'Enchantments',
                            data                    : this.enchantmentsData,
                            backgroundColor         : '#e1ba37',
                            hoverBackgroundColor    : '#b2932c',
                            hoverBorderWidth        : 0,
                            stack                   : 1
                        },
                        {
                            label                   : 'Planeswalker',
                            data                    : this.planeswalkerData,
                            backgroundColor         : '#ff824c',
                            hoverBackgroundColor    : '#c9683e',
                            hoverBorderWidth        : 0,
                            stack                   : 1
                        },
                        {
                            label                   : 'Artifacts',
                            data                    : this.artifactsData,
                            backgroundColor         : '#b2b2b2',
                            hoverBackgroundColor    : '#8a8a8a',
                            hoverBorderWidth        : 0,
                            stack                   : 1
                        }
                    ]
                },
                options : {
                    scales : {
                        xAxes : [ {
                            gridLines : { display : false }
                        } ],
                        yAxes : [ {
                            stacked : true
                        } ]
                    },
                    legend : {
                        display : false
                    }
                }
            } );
        },
        computed : {
            creaturesData() {
                const cmcs = this.createCmcs( this.decklist.creatures.main );
                return cmcs;
            },
            instantsData() {
                const cmcs = this.createCmcs( this.decklist.instants.main );
                return cmcs;
            },
            sorceriesData() {
                const cmcs = this.createCmcs( this.decklist.sorceries.main );
                return cmcs;
            },
            enchantmentsData() {
                const cmcs = this.createCmcs( this.decklist.enchantments.main );
                return cmcs;
            },
            planeswalkerData() {
                const cmcs = this.createCmcs( this.decklist.planeswalker.main );
                return cmcs;
            },
            artifactsData() {
                const cmcs = this.createCmcs( this.decklist.artifacts.main );
                return cmcs;
            }
        },
        methods : {
            createCmcs( list ) {
                const cmcs = [ 0, 0, 0, 0, 0, 0 ];

                list.forEach( ( entry ) => {
                    const cmc = entry.card.cmc;
                    if ( cmc >= 5 ) {
                        cmcs[ 5 ] = cmcs[ 5 ] + entry.qty;
                    }
                    else {
                        cmcs[ cmc ] = cmcs[ cmc ] + entry.qty;
                    }
                } );

                return cmcs;
            }
        }
    };
</script>
