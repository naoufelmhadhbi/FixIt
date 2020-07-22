import {ChangeDetectorRef, Component, ElementRef, OnInit, ViewChild} from '@angular/core';
import {FormBuilder, FormGroup} from '@angular/forms';
import {HttpClient} from '@angular/common/http';
import {PortfolioService} from '../../../Services/PortfolioService/portfolio.service';
import {AuthentificationServiceService} from '../../../Services/AuthentificationService/authentification-service.service';
import {ActivatedRoute, Router} from '@angular/router';
import {User} from '../../Model/user/User';
import {Portfolio} from '../../Model/Portfolio';

@Component({
  selector: 'app-update-image',
  templateUrl: './update-image.component.html',
  styleUrls: ['./update-image.component.css']
})
export class UpdateImageComponent implements OnInit {

  selectedFile: File = null;
  fileToUpload: File = null;
  errorMessage = '';

  /*########################## File Upload ########################*/
  @ViewChild('fileInput') el: ElementRef;
  imageUrl: any = '../assets/images/';
  imageUrlBack: any;
  editFile = true;
  removeUpload = false;


  /*##################### Registration Form #####################*/
  registrationForm = this.fb.group({
    file: [null]
  });

  // registrationForm = new FormGroup({
  //   image: new FormControl(''),
  //   desc: new FormControl('')
  //
  // });

  user: User = null;
  images: Portfolio[] = null;
  name: string;
  desc: string;

  constructor(
    public fb: FormBuilder,
    private cd: ChangeDetectorRef,
    private http: HttpClient,
    private portfolioservice: PortfolioService,
    private authService: AuthentificationServiceService,
    private router: Router,
    private activatedRoute: ActivatedRoute
  ) {
  }

  ngOnInit() {
    this.activatedRoute.params.subscribe(
      (params) => {
        // console.log(params);
        // this.personne = this.cvService.getPersonneById(params.id);
        this.portfolioservice.getimageById(params.id).subscribe(
          (image) => {
            this.images = image;
            // console.log(this.images);
            this.imageUrl = this.imageUrl + this.images[0].image;
            console.log(this.imageUrl);
          }
        );
      }
    );


  }

  // get image() {
  //   return this.registrationForm.get('image');
  // }
  // get desc() {
  //   return this.registrationForm.get('desc');
  // }
  // handleFileInput(file: FileList) {
  //   this.fileToUpload = file.item(0);
  //   var reader = new FileReader();
  //   reader.onload = (event: any) => {
  //     this.imageUrlBack = event.target.result;
  //   };
  //   reader.readAsDataURL(this.fileToUpload);
  // }

  Add(event) {
    if (!(event.target.value == null)) {
      this.desc = event.target.value;

      console.log(this.desc);


      this.UpdatePhoto(this.images[0].id, this.name, this.desc);
      this.name = '';
      this.desc = '';
      alert('Image modifié avec succes');
      this.router.navigate(['/portfolio']);


    } else {
      console.log('lala');
    }
  }

  uploadFile(event) {
    const reader = new FileReader(); // HTML5 FileReader API
    // const file = event.target.files[0];
    this.selectedFile = event.target.files[0] as File;
    if (event.target.files && event.target.files[0]) {
      reader.readAsDataURL(this.selectedFile);

      // When file uploads set it to file formcontrol
      reader.onload = () => {
        this.imageUrl = reader.result;
        this.registrationForm.patchValue({
          file: reader.result
        });
        this.editFile = false;
        this.removeUpload = true;
      };
      // ChangeDetectorRef since file is loading outside the zone
      this.cd.markForCheck();
    }
    if (event.target.files.length > 0) {
      const file = event.target.files[0];
      this.name = event.target.files[0].name;
      console.log(this.name);

    }

  }

  UpdatePhoto(id, name, desc) {
    this.portfolioservice.updateImage(id, name, desc).subscribe(
      (response) => {
      },
      (error) => {
        this.errorMessage = `Problème de connexion à votre serveur.
          Prière de consulter l'adminstrateur`;
        console.log(error);
      }
    );
  }


}
