<template>
    <canvas id="manadistribution"></canvas>
</template>

<script>
    import Chart from 'chart.js';

    export default {
        data() {
            return {
                data : {
                    labels : [
                        'Red',
                        'White',
                        'Green',
                        'Blue',
                        'Black'
                    ],
                    datasets : [
                        {
                            data                    : [ 30, 20, 0, 0, 10 ],
                            backgroundColor         : [
                                '#db8664',
                                '#f0f2c0',
                                '#93b483',
                                '#b5cde3',
                                '#aca29a'
                            ],
                            hoverBackgroundColor    : [
                                '#bf775b',
                                '#dadcb0',
                                '#7e9872',
                                '#96acc0',
                                '#938a83'
                            ]
                        }
                    ]
                },
                options : {
                    legend : { display : false }
                }
            };
        },
        mounted() {
            const data = this.data;
            const options = this.options;

            const ctx = document.getElementById( 'manadistribution' );
            new Chart( ctx, {
                type    : 'pie',
                data    : data,
                options : options
            } );
        }
    };
</script>
