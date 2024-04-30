import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
@Injectable({
  providedIn: 'root'
})
export class TestService {
url :string ='http://localhost:8000';
  constructor(private http:HttpClient) { 
  }
  listData(){
    return this.http.get<any>(this.url+'/api/v1/products');
  }
  listUsers(){
    return this.http.get<any>(this.url+'/api/v1/users');
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
