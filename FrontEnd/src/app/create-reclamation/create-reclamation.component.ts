import {Component, OnInit} from '@angular/core';
import {Reclamation} from '../Model/Reclamation';
import {PublicationService} from '../../Services/PublicationService/publication.service';
import {Router} from '@angular/router';
import {AuthentificationServiceService} from '../../Services/AuthentificationService/authentification-service.service';
import {User} from '../Model/user/User';
import {FormGroup, FormBuilder, Validators} from '@angular/forms';

@Component({
  selector: 'app-create-reclamation',
  templateUrl: './create-reclamation.component.html',
  styleUrls: ['./create-reclamation.component.css']
})
export class CreateReclamationComponent implements OnInit {
  private reclamationModel: Reclamation = new class implements Reclamation {
    id: number;
    // tslint:disable-next-line:variable-name
    id_User: number;
    sujet: string;
    message: string;
    RepRec: string;
    email: string;
    nom: string;
    prenom: string;
  }();

  user: User = null;

  // reclamationModel: Reclamation = null;
  constructor(private publicationService: PublicationService,
              private authSevice: AuthentificationServiceService,
              private router: Router) {
  }

  ngOnInit() {
  }

  OnSubmit() {
    /*this.reclamationModel.sujet = 'zerezrzezer';
    this.reclamationModel.message = 'qdqsdsqdqsd';
    console.log(this.reclamationModel);*/
    this.authSevice.getByUsr().subscribe((data) => {
      this.user = data[0];
      this.addRec(this.reclamationModel, this.user.id);
      this.router.navigate(['/UserRec']);
    });

  }

  addRec(reclamation: Reclamation, id) {
    this.publicationService.CreateReclamation(reclamation, id).subscribe((data1) => {

    });
  }
}
