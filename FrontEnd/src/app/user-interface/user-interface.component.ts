import {Component, OnInit} from '@angular/core';
import {AuthentificationServiceService} from '../../Services/AuthentificationService/authentification-service.service';
import {User} from '../Model/user/User';
import {Router} from '@angular/router';

@Component({
  selector: 'app-user-interface',
  templateUrl: './user-interface.component.html',
  styleUrls: ['./user-interface.component.css']
})
export class UserInterfaceComponent implements OnInit {

  user: User;
  type: string;
  username: string;
  hideforprof: boolean;
  hidefordem: boolean;

  constructor(private authService: AuthentificationServiceService, private router: Router) {
  }

  ngOnInit() {
    this.authService.getByUsr().subscribe((data) => {
      this.user = data[0];
      this.type = this.user.type;
      if (this.type === 'professionnel') {
        this.hideforprof = true;
        this.hidefordem = false;
      } else {
        this.hideforprof = false;
        this.hidefordem = true;
      }
      console.log('kmk,m' + this.user.type);
    });
  }
}
