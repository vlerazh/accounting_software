<template>
    <div >

                    <div class="panel-body">
                        <canvas id="myChart" height="100"></canvas>
                    </div>
            
    </div>
</template>

<script>
    import Chart from 'chart.js'
    import axios from 'axios'
    export default {
        name:'Chart',
        data() {
            return {
                data: [],
                labels: []
            }
        },
        mounted() {
            this.getCustomerData();
            this.update();
            this.drawChart();
        },
        methods: {
            drawChart() {
                let ctx = document.getElementById("myChart");
                let myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: this.labels,
                        datasets: [{
                                label: "Customers",
                                data: this.data,
                                backgroundColor: "rgba(54,73,93,.5)",
                                borderColor: "#36495d",
                                borderWidth: 3
                            },
                        ]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            },
            update() {
                Echo.join('chart')
                    .here((users) => {
                        this.count = users.length;
                        this.drawChart();
                    })
                    .joining((user) => {
                        this.count++;
                        this.drawChart();
                    })
                    .leaving((user) => {
                        this.count--;
                        this.drawChart();
                    });
            },
            getCustomerData(){
                axios.get('http://127.0.0.1:8000/chartCustomers').then(response=>{
                    console.log(response.data.customer_count)
                   this.data = response.data.customer_count
                   this.labels = response.data.months
                }
                )
            }
        }
    }
</script>
