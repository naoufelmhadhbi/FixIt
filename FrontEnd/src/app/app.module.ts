import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { AppComponent } from './app.component';
import { HeaderComponent } from './header/header.component';
import { MessagerieComponent } from './messagerie/messagerie.component';
import { FooterComponent } from './footer/footer.component';
import { SliderComponent } from './slider/slider.component';
import {FormsModule, FormBuilder} from '@angular/forms';
import {HttpClientModule} from '@angular/common/http';
import { UserProfileComponent } from './user-profile/user-profile.component';
import {RoutingModule} from './routing/routing.module';
import {APP_BASE_HREF} from '@angular/common';
import {RouterModule} from '@angular/router';
import { AccueilComponent } from './accueil/accueil.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { MaterialModule } from './material/material.module';
import { UserInterfaceComponent } from './user-interface/user-interface.component';
import { DemandesComponent } from './Publication/demandes/demandes.component';
import { DemandesEncoursComponent } from './Publication/demandes-encours/demandes-encours.component';
import { MesOffresComponent } from './Publication/mes-offres/mes-offres.component';
import { MesTraveauxComponent } from './Publication/mes-traveaux/mes-traveaux.component';
import {AddPublicationComponent} from './Publication/add-publication/add-publication.component';
import { CloturerProjetComponent } from './Publication/cloturer-projet/cloturer-projet.component';

@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    FooterComponent,
    SliderComponent,
    UserProfileComponent,
    AddPublicationComponent,
    AccueilComponent,
    MessagerieComponent,
    UserInterfaceComponent,
    DemandesComponent,
    DemandesEncoursComponent,
    MesOffresComponent,
    MesTraveauxComponent,
    CloturerProjetComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpClientModule,
    RoutingModule,
    RouterModule,
    BrowserAnimationsModule,
    MaterialModule
  ],
  providers: [{provide: APP_BASE_HREF, useValue: '/'}],
  bootstrap: [AppComponent]
})
export class AppModule { }
