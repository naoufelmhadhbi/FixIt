import { Component, OnInit } from '@angular/core';
import {Deplacement} from '../../Model/Deplacement';
import {User} from '../../Model/user/User';
import {Metier} from '../../Model/Metier';
import {ActivatedRoute, Router} from '@angular/router';
import {PortfolioService} from '../../../Services/PortfolioService/portfolio.service';
import {AuthentificationServiceService} from '../../../Services/AuthentificationService/authentification-service.service';

@Component({
  selector: 'app-update-metier',
  templateUrl: './update-metier.component.html',
  styleUrls: ['./update-metier.component.css']
})
export class UpdateMetierComponent implements OnInit {

  metier: Metier[] = null;
  mets: Metier[] = null;
  user: User = null;
  constructor(
    private activatedRoute: ActivatedRoute,
    private portfolioservice: PortfolioService,
    private authService: AuthentificationServiceService,
    private router: Router
  ) {
    this.GetMetier();
  }

  ngOnInit() {
    this.activatedRoute.params.subscribe(
      (params) => {
        console.log(params);
        // this.personne = this.cvService.getPersonneById(params.id);
        this.portfolioservice.getmetierById(params.id).subscribe(
          (metier) => {
            this.metier = metier;
          }
        );
      }
    );
  }


  changePlace(event) {
    let idMetier = event.target.value;
    console.log(idMetier);
    this.authService.getByUsr().subscribe((data) => {
      this.user = data[0];
      // console.log(this.user);
      this.UpdateMet(this.user.id, this.metier[0].id, idMetier);
      this.router.navigate(['/metier']);

    });
  }

  UpdateMet(idProf, idMetOld, idMetNew) {
    this.portfolioservice.updateMtier(idProf, idMetOld, idMetNew).subscribe(
      (response) => {
      },
      (error) => {
        console.log(error);
      }
    );
  }

  GetMetier() {
    this.portfolioservice.getAllMetiers().subscribe((data1) => {
      this.mets = data1;

    });
  }


}
