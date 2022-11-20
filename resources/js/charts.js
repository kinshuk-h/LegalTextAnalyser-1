function makeChart(labels,data,chartName,containerId,isTime=false) {
    let ctx = document.getElementById(containerId).getContext('2d');	

    let chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: chartName,
                backgroundColor: 'rgb(54, 162, 235)',
                borderColor: 'rgb(54, 162, 235)',
                data:data,
            }]
        },
        options: {
            responsive: true,
            //setting to false will prevent the height of the chart from shrinking when resizing
            maintainAspectRatio: false,
            scales:{
                y:{
                    ticks: {
                        callback: function (value) {
                            if(!isTime) return value;
                            let min=new Date(value).getMinutes();
                            let sec=new Date(value).getSeconds()
                            return min+" m "+sec+" s";
                        }
                    }
                }
            },
            plugins:{
                tooltip: {
                    callbacks: {
                      label: (value) =>{
                        if(!isTime) return value.raw;
                        let min=new Date(value.raw).getMinutes();
                        let sec=new Date(value.raw).getSeconds()
                        return min+" m "+sec+" s";
                      } 
                    }
                }
            }
        }
    });
}