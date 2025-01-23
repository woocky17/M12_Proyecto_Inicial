import { Component, OnInit } from '@angular/core';
import { nurseService } from '../service/nurse.service';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Nurse } from '../model/nurse.model';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrl: './login.component.css',
  providers: [nurseService]
})
export class LoginComponent implements OnInit {
  constructor(private nurseService: nurseService) { }

  // nurses: Nurse[] = jsonData;
  nurses: Array<Nurse> = [];
  ngOnInit() {
    this.nurseService.login(new Nurse())
      .subscribe(result => {
        this.nurses = result;
      });
  }
  login() {
    this.nurseService.login(new Nurse());
  }
  get form() {
    return this.nurseService.form;
  }
}
class Nurse {
  id: string = '';
  name: string = '';
  pwd: string = '';
  gmail: string = '';
}
