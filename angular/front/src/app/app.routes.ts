import { Routes } from '@angular/router';
import { CheckoutComponent } from './checkout/checkout.component';
import { AppComponent } from './app.component';
import { SigninComponent } from './signin/signin.component';
import { LoginComponent } from './login/login.component';
import { AuthGuard } from './gurards/auth.guard';
import { OverviewComponent } from './overview/overview.component';
import { DashProductComponent } from './dash-product/dash-product.component';
import { DashCategoriesComponent } from './dash-categories/dash-categories.component';
import { DashOrdersComponent } from './dash-orders/dash-orders.component';
import { DashUsersComponent } from './dash-users/dash-users.component';
import { AddProductComponent } from './add-product/add-product.component';
import { AddCategoryComponent } from './add-category/add-category.component';
import { DashboardComponent } from './dashboard/dashboard.component';
import { HomeComponent } from './home/home.component';
import { EditProductComponent } from './edit-product/edit-product.component';



export const routes: Routes = [
    { path: '', component: SigninComponent },
    { path: 'home', component: HomeComponent ,canActivate:[AuthGuard]},
    { path: '',   redirectTo: '/home', pathMatch: "full" },
    { path: 'checkout', component: CheckoutComponent },
    { path: 'signin', component: SigninComponent },
    { path: 'login', component: LoginComponent},
    {path : "Addproduct", component : AddProductComponent}, 
    {path : "AddCategory", component : AddCategoryComponent},
    {path : "dashboard", children : [
        {path : "overview" , component : OverviewComponent},
        {path : "Allproducts" , component : DashProductComponent , children :[
            {path : "Addproduct" , component : AddProductComponent},
            {path : "editproduct/:id" , component : EditProductComponent},
        ]},
        {path : "Allcategories" , component : DashCategoriesComponent},
        {path : "Allusers" , component : DashUsersComponent},
        {path : "Allorders" , component : DashOrdersComponent},
        {path : "addproduct" , component : AddProductComponent},
        {path : "products/:id/edit" , component : EditProductComponent},
        // { path: '',   redirectTo: '/overview', pathMatch: "prefix" }
    ] ,component : DashboardComponent,canActivate:[AuthGuard]},

   
];
