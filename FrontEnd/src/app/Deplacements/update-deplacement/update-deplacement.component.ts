import {Component, OnInit} from '@angular/core';
import {PortfolioService} from '../../../Services/PortfolioService/portfolio.service';
import {ActivatedRoute, Router} from '@angular/router';
import {Deplacement} from '../../Model/Deplacement';
import {AuthentificationServiceService} from '../../../Services/AuthentificationService/authentification-service.service';
import {User} from '../../Model/user/User';

@Component({
  selector: 'app-update-deplacement',
  templateUrl: './update-deplacement.component.html',
  styleUrls: ['./update-deplacement.component.css']
})
export class UpdateDeplacementComponent implements OnInit {

  deplacement: Deplacement[] = null;
  deps: Deplacement[] = null;
  user: User = null;


  constructor(
    private activatedRoute: ActivatedRoute,
    private portfolioservice: PortfolioService,
    private authService: AuthentificationServiceService,
    private router: Router
  ) {

    // console.log(this.user);
    this.GetDeplacement();

  }

  ngOnInit() {
    this.activatedRoute.params.subscribe(
      (params) => {
        console.log(params);
        // this.personne = this.cvService.getPersonneById(params.id);
        this.portfolioservice.getdeplacementById(params.id).subscribe(
          (deplacement) => {
            this.deplacement = deplacement;
          }
        );
      }
    );
  }

  changePlace(event) {
    let idPlace = event.target.value;
    console.log(idPlace);
    this.authService.getByUsr().subscribe((data) => {
      this.user = data[0];
      // console.log(this.user);
      this.UpdateDep(this.user.id, this.deplacement[0].id, idPlace);
      this.router.navigate(['/deplacement']);

    });
  }

  UpdateDep(idProf, idDepOld, idDepNew) {
    this.portfolioservice.updateDeplacement(idProf, idDepOld, idDepNew).subscribe(
      (response) => {
      },
      (error) => {
        console.log(error);
      }
    );
  }

  GetDeplacement() {
    this.portfolioservice.getAllDeplacements().subscribe((data1) => {
      this.deps = data1;

    });
  }

}
