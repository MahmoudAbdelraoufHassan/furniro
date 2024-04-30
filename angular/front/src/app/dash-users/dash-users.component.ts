import { Component } from '@angular/core';
import { UserCardComponent } from '../user-card/user-card.component';
import { TestService } from '../services/test.service';

@Component({
  selector: 'app-dash-users',
  standalone: true,
  imports: [UserCardComponent],
  templateUrl: './dash-users.component.html',
  styleUrl: './dash-users.component.css'
})

export class DashUsersComponent {
  user ?:any;
  data ?: any;
	constructor(private users: TestService) {}
	
  ngOnInit(): void {
    this.showData();
  }
   
	showData() {
		this.users.listUsers().subscribe(e => {
			this.user = e.users;
		});
	}
}
