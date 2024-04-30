import { Component } from '@angular/core';
import "./login.component.css";
import { HttpClient } from '@angular/common/http';
import { FormBuilder, ReactiveFormsModule,FormGroup,Validators, FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { Router } from '@angular/router';
import { NgIf } from '@angular/common';
import { LoginService } from './../services/login.service';
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
  loginErrorEmail:any;
  loginErrorPass:any;
   
  constructor(private fb: FormBuilder,private router:Router,private loginService:LoginService) {
    this.loginForm = this.fb.group({
      email:['',[Validators.required,Validators.minLength(4),Validators.maxLength(55),Validators.pattern(/^[a-zA-Z0-9._%+-]+@(gmail|yahoo ?)+\.[a-zA-Z]{2,}$/)]],
      password:['',[Validators.required,Validators.minLength(4),Validators.maxLength(15),]],

    });
  }
//Validators.pattern(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$/)
  login(){
   const userData=this.loginForm.value;
   this.loginError="";
   this.hideErrorApi=true
  //  if the validtion form status is true fire register user for api
if (this.loginForm.valid) {  
   this.loginService.Login(userData).subscribe(
    (res:any) => {
      // login successful
      const personData=res.user;
      const tokenLogin=res.token;
      const role=res.user.role;      
      if (role=="admin") {
            //this.router.navigate(["/dashboard/admin"]);  
            localStorage.setItem("Person",JSON.stringify(personData)) //info about Admin who that logged in         
            localStorage.setItem("currentRole",role);  
            localStorage.setItem("currentAdminToken",tokenLogin);
             this.loginService.isAdmin(true);
             this.router.navigate(['/home']);

      }else{
        //   this.router.navigate(["/dashboard/user"]); 
        this.loginService.isAdmin(false);
          localStorage.setItem("Person",JSON.stringify(personData))//info about person who that logged in      
          localStorage.setItem("currentRole",role);   
          localStorage.setItem("currentUserToken",tokenLogin); 
          this.router.navigate(["/home"]) 
      }
      console.log('login successful');
      // empty all errors 
      this.loginErrorEmail=""
      this.loginErrorPass=""
      this.loading = true;
      this.loginError="";
    },
    (error) => {
      // login failed
      if (error.status === 401 && error.error ) {
       console.log(error.error);  
       const errorEmailApi=error?.error?.errors?.email?.join(" ");
       const errorPassApi=error?.error?.password?.join(" ");
       const errorLoginApi=error?.error?.message
 
       this.loginError=errorLoginApi;
 
        this.loginErrorEmail = errorEmailApi;
        this.loginErrorPass = errorPassApi;
 
 
      } else {
        this.loginError= 'An error occurred during registration';
        
      }
      
      
    }
  );
}else{
  //  if the validtion form status is false fire custom validation in here
  this.loginErrorEmail=""
  this.loginErrorPass=""
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
