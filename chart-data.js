const ctx = document.getElementById('myChart').getContext('2d');

fetch("chart-data.php")
  .then(response => response.json())
  .then(data => {
    const labels = data.map(item => item.category);
    const values = data.map(item => item.total);

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: 'Number of Reports',
          data: values,
          backgroundColor: 'rgba(123, 97, 255, 0.7)',
          borderColor: '#7B61FF',
          borderWidth: 1
        }]
      },
      options: {
        plugins: {
          title: {
            display: true,
            text: 'Report Counts per Category'
          },
          legend: {
            display: false
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              stepSize: 1
            }
          }
        }
      }
    });
  });
