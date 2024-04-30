import { Component } from '@angular/core';
import { LandingComponent } from '../landing/landing.component';
import { CategoriesComponent } from '../categories/categories.component';
import { OffersComponent } from '../offers/offers.component';

import { CategoryListComponent } from '../category-list/category-list.component';
import { ScrollUpComponent } from '../scroll-up/scroll-up.component';
import { ServiceComponent } from '../service/service.component';
import { NavbarComponent } from '../navbar/navbar.component';
import { FooterComponent } from '../footer/footer.component';
@Component({
  selector: 'app-home',
  standalone: true,
  imports: [NavbarComponent,FooterComponent,LandingComponent, CategoriesComponent, OffersComponent  , CategoryListComponent , ScrollUpComponent,ServiceComponent],
  templateUrl: './home.component.html',
  styleUrl: './home.component.css'
})
export class HomeComponent {
  
}
