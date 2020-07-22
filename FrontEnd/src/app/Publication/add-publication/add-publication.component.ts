import {Component, OnInit} from '@angular/core';
import {PublicationService} from '../../../Services/PublicationService/publication.service';
import {Router} from '@angular/router';
import {Publication} from '../../Model/Publication';
import {HttpHeaders} from '@angular/common/http';
import {Metier} from '../../Model/Metier';

@Component({
  selector: 'app-add-publication',
  templateUrl: './add-publication.component.html',
  styleUrls: ['./add-publication.component.css']
})
export class AddPublicationComponent implements OnInit {
  metiers: Metier[];
  constructor(private publicationService: PublicationService, private router: Router) {
    this.publication = {
      detail: '',
      titre: '',
      etat: '',
      date_pub: null,
      id: 2,
      id_demandeur:  Number(localStorage.getItem('UserId')),
      professionnel_id: null,
      username: '',
      id_metier: null,
    };
  }

  publication: Publication;

  ngOnInit() {
    this.publicationService.metiers().subscribe((data) => {
      this.metiers = data;
    });
  }

  addPublication() {

    console.log(JSON.stringify(this.publication));
    this.publicationService.addPublication(JSON.stringify(this.publication)).subscribe((data) => {
      console.log(data);
    });
    this.router.navigateByUrl('/AddPublication', { skipLocationChange: true }).then(() => {
      this.router.navigate(['/AddPublication']);
    });
  }
}
