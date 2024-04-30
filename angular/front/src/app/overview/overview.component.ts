import { Component } from '@angular/core';
import Chart from 'chart.js/auto';
@Component({
  selector: 'app-overview',
  standalone: true,
  imports: [],
  templateUrl: './overview.component.html',
  styleUrl: './overview.component.css'
})
export class OverviewComponent {
pie?: any;
chart?: any;
constructor() {}
ngOnInit() {

  this.pie = new Chart('canvas', {
    type: 'doughnut',
    data: {
      labels: ['Red', 'Blue', 'Yellow'],
      datasets: [
        {
          label: '# of data',
          data: [12, 19, 3],
          borderWidth: 1,
        },
      ],
    },
    options: {
    },
  });

  this.chart = new Chart('canvas2', {
    type: 'line',
    data: {
      labels: ['Red', 'Blue', 'Yellow'],
      datasets: [{
        label: 'My First Dataset',
        data: [65, 59, 80, 81, 56, 55, 40],
        fill: false,
        borderColor: 'rgb(75, 192, 192)',
        tension: 0.3
      },{
        label: 'My second Dataset',
        data: [80, 50, 10, 81, 41, 55, 40],
        fill: false,
        borderColor: 'red',
        tension: 0.3
      } 
    ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
}
}
