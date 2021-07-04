<template>
    <div >
        <div class="panel-body">
            <canvas id="itemChart" height="100"></canvas>
        </div>
    </div>
</template>

<script>
    import Chart from 'chart.js'
    import axios from 'axios'
    export default {
        name:'ItemChart',
        data() {
            return {
               
            }
        },
        mounted() {
            this.drawChart();
        },
        methods: {
            drawChart() {
                axios.get('http://host.docker.internal:8000/chartItems').then(response=>{
                    console.log(response.data)
                     let ctx = document.getElementById("itemChart");
                
                    let myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: response.data.names,
                            datasets: [{
                                    label: "Items",
                                    data: response.data.total_quantity,
                                    backgroundColor: "rgba(255,167,38,0.5)",
                                    borderColor: "rgb(255,167,38)",
                                    borderWidth: 3
                                },
                            ]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        min: 0,
                                        max: response.data.max
                                    }
                                }]
                            }
                        }
                    });
                })
               
            },
        }
    }
</script>
