import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { UpdateMetierComponent } from './update-metier.component';

describe('UpdateMetierComponent', () => {
  let component: UpdateMetierComponent;
  let fixture: ComponentFixture<UpdateMetierComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ UpdateMetierComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(UpdateMetierComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
