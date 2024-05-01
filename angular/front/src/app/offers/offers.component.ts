import { Component } from '@angular/core';
import productJson from '../../assets/products-list.json';
import { RouterLink, RouterLinkActive } from '@angular/router';

@Component({
  selector: 'app-offers',
  standalone: true,
  imports: [RouterLink , RouterLinkActive],
  templateUrl: './offers.component.html',
  styleUrl: './offers.component.css'
})
export class OffersComponent {
  images = [
    {
      imgSrc: '../assets/edc-web-tour-natasha-bardaran-3-1607305889.jpg',
    imgArc: 'image 1',
    },
    {
      imgSrc: '../assets/OIP (1).jpg',
      imgArc: 'image 2',
    },
    {
      imgSrc: '../assets/OIP.jpg',
      imgArc: 'image 3',
    }
  ]

  products : Array<any> = productJson ;
}
