import { NgIf } from '@angular/common';
import { HttpClientModule } from '@angular/common/http';
import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { TestService } from '../services/test.service';

@Component({
  selector: 'app-add-product',
  standalone: true,
  imports: [NgIf,FormsModule,HttpClientModule],
  templateUrl: './add-product.component.html',
  styleUrl: './add-product.component.css'
})
export class AddProductComponent {



    
  name! : string;
  quantity! : string;
  price! : string;
  errors : any =[];
  file! : any;
  image!:any;

  saveProducts(){
    var inputData ={
      name: this.name,
      quantity : this.quantity,
      price: this.price,
      image : this.image
    }

    this.testS.saveProducts(inputData).subscribe({
      next: (res:any) => {
        console.log(res , 'response');
        alert( res.message);
        this.name = '';
        this.quantity = '';
        this.price = '';
        this.image = '';

        
      },
      error: (err : any) =>{
        this.errors = err.error.errors;
        console.log(err.error.errors ,'errors');
      }
    })
  }

  constructor(private testS: TestService) {}

}
