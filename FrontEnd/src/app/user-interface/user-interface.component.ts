import {Component, OnInit} from '@angular/core';
import {AuthentificationServiceService} from '../../Services/AuthentificationService/authentification-service.service';
import {User} from '../Model/user/User';
import {ActivatedRoute, Router, RouterModule} from '@angular/router';

@Component({
  selector: 'app-user-interface',
  templateUrl: './user-interface.component.html',
  styleUrls: ['./user-interface.component.css']
})
export class UserInterfaceComponent implements OnInit {
  isActiveReclamation = 'nav-item';
  isActiveDeplacement = 'nav-item';

  constructor(private authService: AuthentificationServiceService,
              private router: Router,
              private route: ActivatedRoute) {
    //if(localStorage.getItem('JwtToken') == null || localStorage.getItem('JwtToken') == undefined)
    //this.router.navigate(['/acceuil']);
  }

  ngOnInit() {
    console.log('c\'est la route' + this.route);
    console.log('c\'est la route' + this.router.url);
    // tslint:disable-next-line:triple-equals
    if (this.router.url == '/reclamation') {
      console.log('mar7be');
      this.isActiveReclamation = 'nav-item active';
    }
    // tslint:disable-next-line:triple-equals
    if (this.router.url == '/deplacement') {
      console.log('mar7be');
      this.isActiveDeplacement = 'nav-item active';
    }
  }


}
