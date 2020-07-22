import { Component, OnInit } from '@angular/core';
import {PortfolioService} from '../../../Services/PortfolioService/portfolio.service';
import {AuthentificationServiceService} from '../../../Services/AuthentificationService/authentification-service.service';
import {Router} from '@angular/router';
import {Deplacement} from '../../Model/Deplacement';
import {User} from '../../Model/user/User';
import {Metier} from '../../Model/Metier';

@Component({
  selector: 'app-add-metier',
  templateUrl: './add-metier.component.html',
  styleUrls: ['./add-metier.component.css']
})
export class AddMetierComponent implements OnInit {

  private metier: Metier[] = [];
  user: User = null;

  constructor(
    private portfolioservice: PortfolioService,
    private authService: AuthentificationServiceService,
    private router: Router
  ) { }

  ngOnInit() {
    this.portfolioservice.getAllMetiers().subscribe((data) => {
      this.metier = data;

    });
  }

  changePlace(event) {
    let idMetier = event.target.value;
    console.log(idMetier);
    this.authService.getByUsr().subscribe((data) => {
      this.user = data[0];
      // console.log(this.user);
      this.addMet(this.user.id, idMetier);
      this.router.navigate(['/metier']);

    });
  }

  addMet(idProf, idMet) {
    this.portfolioservice.addmetier(idProf, idMet).subscribe(
      (response) => {
      },
      (error) => {
        console.log(error);
      }
    );
  }

}
