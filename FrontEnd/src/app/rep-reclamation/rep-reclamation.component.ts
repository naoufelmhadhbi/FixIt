import {Component, OnInit} from '@angular/core';
import {Reclamation} from '../Model/Reclamation';
import {ActivatedRoute, Router} from '@angular/router';
import {PublicationService} from '../../Services/PublicationService/publication.service';

@Component({
  selector: 'app-rep-reclamation',
  templateUrl: './rep-reclamation.component.html',
  styleUrls: ['./rep-reclamation.component.css']
})
export class RepReclamationComponent implements OnInit {

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

  constructor(private activatedRoute: ActivatedRoute,
              private publication: PublicationService,
              private router: Router) {
  }

  ngOnInit() {
    this.activatedRoute.params.subscribe(
      (params) => {
        this.publication.GetReclamationsById(params.id).subscribe(
          (reclamation) => {
            this.reclamationModel = reclamation;

          }
        );
      }
    );
  }

  update() {
    this.publication.Response(this.reclamationModel.id, this.reclamationModel.RepRec).subscribe(
      (answer) => {
        this.router.navigate(['/reclamation']);
      }
    );
  }
}
