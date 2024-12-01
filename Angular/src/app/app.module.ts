import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { LoginComponent } from './login/login.component';
import {GetAllComponent} from './get-all/get-all.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { FindNurseComponent } from './find-nurse/find-nurse.component';

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    GetAllComponent,
    FindNurseComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    ReactiveFormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
