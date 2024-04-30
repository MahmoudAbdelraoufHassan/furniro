import { Component } from '@angular/core';
import "./signin.component.css";
import { HttpClient } from '@angular/common/http';
import { FormBuilder, ReactiveFormsModule,FormGroup,Validators, FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { Router } from '@angular/router';
import { NgIf } from '@angular/common';

@Component({
  selector: 'app-signin',
  standalone: true,
  imports: [ReactiveFormsModule,FormsModule,HttpClientModule,NgIf],
  templateUrl: './signin.component.html',
  styleUrl: './signin.component.css'
})
export class SigninComponent {
  loading: boolean = false;
  isChecked=1
  hideErrorApi=true;

  registrationForm: FormGroup;
  registrationErrorName:any;
  registrationErrorEmail:any;
  registrationErrorPass:any;

  constructor(private fb: FormBuilder, private httpApiRegister: HttpClient,private router:Router) {
    this.registrationForm = this.fb.group({
      LastName:['',[Validators.required,Validators.minLength(4),Validators.maxLength(15),Validators.pattern(/^[a-zA-Z_]+$/)]],
      name:['',[Validators.required,Validators.minLength(4),Validators.maxLength(15),Validators.pattern(/^[a-zA-Z_]+$/)]],
      email:['',[Validators.required,Validators.minLength(4),Validators.maxLength(55),Validators.pattern(/^[a-zA-Z0-9._%+-]+@(gmail|yahoo ?)+\.[a-zA-Z]{2,}$/)]],
      password:['',[Validators.required,Validators.minLength(4),Validators.maxLength(15),Validators.pattern(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$/)]],

    });
  }


  onSubmit(){
this.hideErrorApi=true;
  //  if the validtion form status is true fire register user for api
if (this.registrationForm.valid) {  
 this.httpApiRegister.post('http://127.0.0.1:8000/api/v1/auth/register', this.registrationForm.value).subscribe(
   (res) => {
     // Registration successful
    // console.log(res);
     //console.log('Registration successful');
     // You may navigate to another page or display a success message here
     this.registrationErrorName=""
     this.registrationErrorEmail=""
     this.registrationErrorPass=""
     this.loading = true;

   //  this.router.navigate(['/checkout']);


     
   },
   (error) => {
     // Registration failed
     // console.log(error); 
     if (error.status === 422 && error.error ) {
      //  console.log(error?.error?.errors?.name?.join(" ")); 
      //  console.log(error?.error?.errors?.email?.join(" ")); 
      //  console.log(error?.error?.errors?.password?.join(" ")); 

      const errorNameApi=error?.error?.errors?.name?.join(" ");
      const errorEmailApi=error?.error?.errors?.email?.join(" ");
      const errorPassApi=error?.error?.errors?.password?.join(" ");

       this.registrationErrorName = errorNameApi;
       this.registrationErrorEmail = errorEmailApi;
       this.registrationErrorPass = errorPassApi;

     } else {
      //console.error('Registration failed:', error);
       this.registrationErrorName = 'An error occurred during registration';
       
     }
     
     //console.error('Registration failed:', error);
      //this.registrationError = error.message || 'An error occurred during registration';
   }
 );
}else{
  //  if the validtion form status is false fire custom validation in here
  this.registrationErrorName=""
  this.registrationErrorEmail=""
  this.registrationErrorPass=""
    //  if the validtion form status is false fire all fields are touched and display the errors
  this.markFormGroupTouched(this.registrationForm);


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
