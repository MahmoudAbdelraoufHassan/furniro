import { Component } from '@angular/core';
import "./login.component.css";
import { HttpClient } from '@angular/common/http';
import { FormBuilder, ReactiveFormsModule,FormGroup,Validators, FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { Router } from '@angular/router';
import { NgIf } from '@angular/common';
import { log } from 'console';

@Component({
  selector: 'app-login',
  standalone: true,
  imports: [ReactiveFormsModule,FormsModule,HttpClientModule,NgIf],
templateUrl: './login.component.html',
  styleUrl: './login.component.css'
})
export class LoginComponent {
  loading: boolean = false;
  loginForm: FormGroup;
  loginError:any;
  hideErrorApi=true;
  registrationErrorEmail:any;
  registrationErrorPass:any;
  // let f:any=document.querySelector(".f");
   
  constructor(private fb: FormBuilder, private httpApiProducts: HttpClient,private router:Router) {
    this.loginForm = this.fb.group({
      email:['',[Validators.required,Validators.minLength(4),Validators.maxLength(55),Validators.pattern(/^[a-zA-Z0-9._%+-]+@(gmail|yahoo ?)+\.[a-zA-Z]{2,}$/)]],
      password:['',[Validators.required,Validators.minLength(4),Validators.maxLength(15),]],

    });
  }
//Validators.pattern(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$/)

  onSubmit(){
   const baseApiLogin="http://127.0.0.1:8000/api/v1/auth/login";
   console.log(this.loginError);
   console.log(this.loginForm.valid);
   this.hideErrorApi=true

  //  if the validtion form status is true fire register user for api
if (this.loginForm.valid) {  
 this.httpApiProducts.post(baseApiLogin, this.loginForm.value).subscribe(
   (res:any) => {
     // login successful
     const tokenLogin=res.token;
     const role=res.user.role;
     console.log(role) ;
     if (role=="admin") {
           this.router.navigate(["/dashboard/admin"]);   
           localStorage.setItem("currentRole",role);  
           localStorage.setItem("currentAdminToken",tokenLogin);  
      
     }else{
          this.router.navigate(["/dashboard/user"]);  
          localStorage.setItem("currentRole",role);   
           localStorage.setItem("currentUserToken",tokenLogin);  
      

     }

     console.log('login successful');
     // You may navigate to another page or display a success message here
     this.registrationErrorEmail=""
     this.registrationErrorPass=""
     this.loading = true;

   //  this.router.navigate(['/checkout']);


     
   },
   (error) => {
     // login failed
    //  console.error(error)
      // console.log(error.status); 
     if (error.status === 401 && error.error ) {
      console.log(error.error.message);  
      //  console.log(error?.error?.errors?.email?.join(" ")); 
      //  console.log(error?.error?.errors?.password?.join(" ")); 
     
      const errorEmailApi=error?.error?.errors?.email?.join(" ");
      const errorPassApi=error?.error?.password?.join(" ");
      const errorLoginApi=error?.error?.message

      this.loginError=errorLoginApi;

       this.registrationErrorEmail = errorEmailApi;
       this.registrationErrorPass = errorPassApi;


     } else {
       this.loginError= 'An error occurred during registration';
       
     }
     
     
   }
 );
}else{
  //  if the validtion form status is false fire custom validation in here
  this.registrationErrorEmail=""
  this.registrationErrorPass=""
  this.loginError=""
    //  if the validtion form status is false fire all fields are touched and display the errors
  this.markFormGroupTouched(this.loginForm);


}
 
  }


  // if i submited the data make all fileds touched
  markFormGroupTouched(formGroup: FormGroup) {
    Object.values(formGroup.controls).forEach(control => {
      control.markAsTouched();
      if (control instanceof FormGroup) {
        this.markFormGroupTouched(control);
      }
    });
  }

  hideError(){
this.hideErrorApi=false;

   
   }
}
