import { Component } from '@angular/core';
import { DecimalPipe, NgFor, NgIf } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { NgbPaginationModule, NgbTypeaheadModule } from '@ng-bootstrap/ng-bootstrap';
import { TestService } from '../services/test.service';
import { RouterLink, RouterLinkActive, RouterOutlet } from '@angular/router';
import { AddProductComponent } from '../add-product/add-product.component';
@Component({
  selector: 'app-dash-product',
  standalone: true,
  imports: [DecimalPipe , FormsModule , NgbPaginationModule ,AddProductComponent,NgFor, NgIf , RouterLink , RouterLinkActive,RouterOutlet],
  templateUrl: './dash-product.component.html',
  styleUrl: './dash-product.component.css'
})
export class DashProductComponent {
	page = 1;
	pageSize = 4;
	collectionSize: number = 0;
	test: any;
	data!: any[];
	result: any[] = [];

	trackById(index: number, item: any): number {
		return item.id;
	}
	
	constructor(private testS: TestService) {}
	
	ngOnInit(): void {
		this.showData();
	}
	
	showData() {
		this.testS.listData().subscribe(e => {
			this.test = e;
			this.data = this.test;
			this.collectionSize = this.data.length;
			this.refreshData();
			console.log(this.test)
		});
	}

    
	// destroy logic
	deleteProduct(event:any , productId :any){
		if(confirm('are you sure you want to delete')){
	event.target.innerText = "Deleting";
	
		  this.testS.destroyProduct(productId).subscribe((res:any) => {
			console.log(res);
			this.showData();
		  });
		}
	
	  }






	// pagination logic
	
	refreshData() {
		this.result = this.data
			.map((item, index) => ({ id: index + 1, ...item }))
			.slice((this.page - 1) * this.pageSize, this.page * this.pageSize);
	}
	
	}