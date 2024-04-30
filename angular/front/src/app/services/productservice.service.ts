import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class ProductserviceService {

  url:string = 'http://localhost:8000';

  constructor(private http:HttpClient) { }

  // here we get all products from api
  getProducts() {
    return this.http.get(this.url + '/api/v1/products');
  }

  // get data of single product
  getProduct(productId : any){
    return this.http.get(this.url+`/api/v1/products/${productId}`);

  }
  // update data of single product

  updateProduct(InputData : any , productId : any){
    console.log(InputData);
     return this.http.put(this.url+`/api/v1/products/${productId}`,InputData);
   }
 

   // save the update

   saveProducts(inputData : object){
     return this.http.post(this.url+`/api/v1/products`,inputData);
   }

   // delete product
 
   destroyProduct(productId : any){
     return this.http.delete(this.url+`/api/v1/products/${productId}`);
   }
}
