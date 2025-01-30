import { Component } from '@angular/core';
import { nurseService } from '../service/nurse.service';

@Component({
  selector: 'app-sign-in',
  templateUrl: './sign-in.component.html',
  styleUrls: ['./sign-in.component.css'],
})
export class SignInComponent {
  constructor(private nurseService: nurseService) { }
  signIn(){
    this.nurseService.signIn();
  }
  get form() {
    return this.nurseService.form;
  }
}
