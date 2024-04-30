import { Component } from '@angular/core';
import "./checkout.component.css"
import { ScrollUpComponent } from '../scroll-up/scroll-up.component';
import {ReactiveFormsModule,FormGroup,Validators,FormBuilder} from "@angular/forms"
import { Router } from '@angular/router';

@Component({
  selector: 'app-checkout',
  standalone: true,
  imports: [ScrollUpComponent,ReactiveFormsModule],
templateUrl: './checkout.component.html',
  styleUrl: './checkout.component.css'
})
export class CheckoutComponent {
  dataUser:FormGroup;
  constructor(private fb: FormBuilder,private router: Router) {
    this.dataUser=this.fb.group({
      firstName:['',[Validators.required,Validators.minLength(4),Validators.maxLength(15),Validators.pattern(/^[a-zA-Z_]+$/)]],
      lastName:['',[Validators.required,Validators.minLength(4),Validators.maxLength(15),Validators.pattern(/^[a-zA-Z_]+$/)]],
      country:['',[Validators.required]],
      street:['',[Validators.required,Validators.minLength(4),Validators.maxLength(15),Validators.pattern(/^[a-zA-Z0-9_]+$/)]],
      city:['',[Validators.required,Validators.minLength(4),Validators.maxLength(15),Validators.pattern(/^[a-zA-Z_]+$/)]],
      zipCode:['',[Validators.required,Validators.minLength(4),Validators.maxLength(10),Validators.pattern(/^[0-9_]+$/)]],
      phone:['',[Validators.required,Validators.minLength(4),Validators.maxLength(10),Validators.pattern(/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/)]],
      email:['',[Validators.required,Validators.minLength(10),Validators.maxLength(30),Validators.pattern(/^[a-zA-Z0-9._%+-]+@(gmail|yahoo ?)+\.[a-zA-Z]{2,}$/)]],







    
    })


  }
  handlePlaceOrder(){
    this.markFormGroupTouched(this.dataUser);
    console.log(this.dataUser.status=="VALID");
    if (this.dataUser.status=="VALID") {
      console.log("Your data is submited");
      this.router.navigate(['/']);


    }else{
      console.log("Your data  Not submited");
      // console.log(this.loginForm.status);
  
    }
  }
// if i submit data and not valid or empty make all input touched and show it's errors
markFormGroupTouched(formGroup: FormGroup) {
  Object.values(formGroup.controls).forEach(control => {
    control.markAsTouched();
    if (control instanceof FormGroup) {
      this.markFormGroupTouched(control);
    }
  });
}

















  ngOnInit(){
    // let c=document.querySelector(".firstName");
    // console.log(c);
    
    
  }

 

}
