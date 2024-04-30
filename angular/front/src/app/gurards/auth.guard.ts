// import { inject } from '@angular/core';
// import { CanActivateFn ,Router} from '@angular/router';

// export const authGuard: CanActivateFn = (route, state) => {
//    const router=inject(Router);
//   if (0) {
//     return true
    
//   }else{
//     console.log("g");
//   router.navigateByUrl("/checkout")
//     return false;
    
//   }

//   // if(localStorage.getItem('currentRole')=="admin"  ){
//   //   return true
//   // }else{
//   //   return false;
//   // }
//   // alert("You can't access this page")
// };
// --------------------------------other way-----------------------------
 import { CanActivate } from '@angular/router';
import { Injectable } from '@angular/core';
import {Router,  ActivatedRouteSnapshot, RouterStateSnapshot } from '@angular/router';
import { LoginService } from '../services/login.service';
import { log } from 'util';

@Injectable({
  providedIn: 'root'
})
export class AuthGuard implements CanActivate {
  constructor(private router: Router,private loginService: LoginService) {}

  canActivate(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): boolean {
   // return false;
    if(localStorage.getItem("Admin")=="true"){
        this.router.navigate(['/checkout']);
        console.log("0g");
         return true

        }else if(localStorage.getItem("Admin")=="false"){
          console.log(route);
           
          // this.router.navigate(['/home']);
          return true;
           
        
        }else{
          this.router.navigate(['/login']);
          console.log(this.loginService.Admin);
          return false;
          


        }
  }
}
