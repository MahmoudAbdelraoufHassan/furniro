import { Component } from '@angular/core';
import { CaresoulComponent } from '../caresoul/caresoul.component';
@Component({
  selector: 'app-categories',
  standalone: true,
  imports: [CaresoulComponent],
  templateUrl: './categories.component.html',
  styleUrl: './categories.component.css',
})
export class CategoriesComponent {
heading : string ="categories";
}
