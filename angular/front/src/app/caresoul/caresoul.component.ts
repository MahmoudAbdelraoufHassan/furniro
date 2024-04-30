import { Component  ,ViewChild , ElementRef} from '@angular/core';
import { CategoryListComponent } from '../category-list/category-list.component';
import { CategoryCardComponent } from '../category-card/category-card.component';

@Component({
  selector: 'app-caresoul',
  standalone: true,
  imports: [ CategoryCardComponent],
  templateUrl: './caresoul.component.html',
  styleUrl: './caresoul.component.css'
})
export class CaresoulComponent {
  @ViewChild("ele") ele?: ElementRef;
next(){
  let move = this.ele?.nativeElement;
  move.scrollBy(526 , 0);
  
}
prev(){
  let move = this.ele?.nativeElement;
  move.scrollBy(-500 , 0);
}
}
