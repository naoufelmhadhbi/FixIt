import { NgModule } from '@angular/core';
import { CommonModule, } from '@angular/common';
import { BrowserModule  } from '@angular/platform-browser';
import { Routes, RouterModule } from '@angular/router';


import {FooterComponent} from './footer/footer.component';

const routes: Routes =[
    { path: 'home',             component: FooterComponent },
    { path: 'user-profile',     component: FooterComponent },
    { path: 'register',           component: FooterComponent },
    { path: 'landing',          component: FooterComponent },
    { path: 'login',          component: FooterComponent },
    { path: '', redirectTo: 'home', pathMatch: 'full' }
];

@NgModule({
  imports: [
    CommonModule,
    BrowserModule,
    RouterModule.forRoot(routes,{
      useHash: true
    })
  ],
  exports: [
  ],
})
export class AppRoutingModule { }
