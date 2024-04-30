import { Component } from '@angular/core';
import { TestService } from '../services/test.service';
import { ActivatedRoute } from '@angular/router';
import { FormsModule } from '@angular/forms';
import { NgIf } from '@angular/common';

@Component({
  selector: 'app-edit-product',
  standalone: true,
  imports: [FormsModule ,NgIf],
  templateUrl: './edit-product.component.html',
  styleUrl: './edit-product.component.css'
})
export class EditProductComponent {

  
  constructor(private route: ActivatedRoute, private testS: TestService ){}

  errors : any =[];
  product!:any;
  productId! : any;

  name! : string;
  price! : string;
  quantity!:string;
  ngOnInit(){
    this.productId = this.route.snapshot.paramMap.get('id');

    this.testS.getProduct(this.productId).subscribe(res =>{
      console.log(res);
      this.product = res;
    })
  }
  updateProduct()
  {
    var InputData = {
        name: this.product.name,
        quantity: this.product.quantity,
        price: this.product.price
    }

    this.testS.updateProduct(InputData,this.productId).subscribe({
      next : (res:any) =>{
        console.log(res);

      },
      error : (err) => {
        this.errors = err.error.errors;
        console.log(err);
      }
    });
  }


}
