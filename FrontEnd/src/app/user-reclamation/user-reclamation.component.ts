import {Component, OnInit} from '@angular/core';
import {Reclamation} from '../Model/Reclamation';
import {PublicationService} from '../../Services/PublicationService/publication.service';
import {Router} from '@angular/router';
import {AuthentificationServiceService} from '../../Services/AuthentificationService/authentification-service.service';
import {ReclamationComponent} from '../reclamation/reclamation.component';
import {User} from '../Model/user/User';

@Component({
  selector: 'app-user-reclamation',
  templateUrl: './user-reclamation.component.html',
  styleUrls: ['./user-reclamation.component.css']
})
export class UserReclamationComponent implements OnInit {
  private reclamationModel: Reclamation = new class implements Reclamation {
    id: number;
    // tslint:disable-next-line:variable-name
    id_User: number;
    message: string;
    sujet: string;
    RepRec: string;
    email: string;
    nom: string;
    prenom: string;
  }();
  getRec: Reclamation[];

  constructor(private publicationService: PublicationService,
              private router: Router,
              private authSevice: AuthentificationServiceService
  ) {
  }

  user: User = null;

  ngOnInit() {
    this.authSevice.getByUsr().subscribe((data) => {
      this.user = data[0];
      this.getRecByUser(this.user.id);
    });

  }

  getRecByUser(id) {
    this.publicationService.GetReclamationsUser(id).subscribe((data1) => {
      this.getRec = data1;
      console.log(data1);
    });
  }

}
