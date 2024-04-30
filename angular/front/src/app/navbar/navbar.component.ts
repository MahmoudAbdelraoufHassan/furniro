import { Component, HostListener } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterLink, RouterLinkActive } from '@angular/router';
@Component({
  selector: 'app-navbar',
  standalone: true,
  imports: [CommonModule ,RouterLink , RouterLinkActive],
  templateUrl: './navbar.component.html',
  styleUrl: './navbar.component.css'
})
export class NavbarComponent {
  userActive: boolean = false;
  menuActive:boolean = false;
  moved:boolean = false;
  
  toggleUser() {
    if(this.menuActive){
      this.menuActive = !this.menuActive;
    }
      this.userActive = !this.userActive;
  }
  toggleMenu() {
    if(this.userActive){
      this.userActive = !this.userActive;
    }
    this.menuActive = !this.menuActive;
  }
 @HostListener('window:scroll', [])
  onScroll() {
    this.moved = window.scrollY > 300;
  }
}

