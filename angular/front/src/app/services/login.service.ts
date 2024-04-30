import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class LoginService {
   Admin:any;
  constructor(private httpApiLogin:HttpClient) { }
// for login user | admin
  baseApiLogin="http://127.0.0.1:8000/api/v1/auth/login";
  Login(userData:any) {
   return this.httpApiLogin.post(this.baseApiLogin,userData);
  
  }
  isAdmin(val:boolean){
    console.log(val);
    this.Admin=val;
    localStorage.setItem("Admin",this.Admin)
    console.log(localStorage.getItem("Admin"));
    
    return val;
  }



}
