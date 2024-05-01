import { Component } from '@angular/core';
import { FormsModule, NgModel } from '@angular/forms';
import productJson from '../../assets/products-list.json';
import { TestService } from '../services/test.service';


@Component({
  selector: 'app-products',
  standalone: true,
  imports: [FormsModule],
  templateUrl: './products.component.html',
  styleUrl: './products.component.css'
})
export class ProductsComponent {

  products : Array<any> = productJson ;

  constructor(private testS: TestService) {}
	
	ngOnInit(): void {
		this.showData();
	}
  test : any ;

  showData() {
		this.testS.listData().subscribe(e => {
			this.test = e;
			console.log(this.test);
		});
	}
}
