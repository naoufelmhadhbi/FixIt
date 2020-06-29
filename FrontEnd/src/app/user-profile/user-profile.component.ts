import {Component, OnInit} from '@angular/core';
import {AuthentificationServiceService} from "../../Services/AuthentificationService/authentification-service.service";
import {User} from "../Model/user/User";

@Component({
  selector: 'app-user-profile',
  templateUrl: './user-profile.component.html',
  styleUrls: ['./user-profile.component.css']
})
export class UserProfileComponent implements OnInit {

  constructor(private authService: AuthentificationServiceService) {
  }

  username: string;
  user: User;

  ngOnInit() {
    this.authService.getByUsr().subscribe((data) => {
      this.user = data[0];
    })
  }

  test() {

  }

}
